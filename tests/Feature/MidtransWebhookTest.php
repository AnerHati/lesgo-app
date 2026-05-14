<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Role;
use App\Models\StudyClass;
use App\Models\Transaction;
use App\Models\Package;
use App\Models\Subject;
use App\Enums\StudyClassStatus;
use App\Enums\TransactionStatus;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MidtransWebhookTest extends TestCase
{
    use RefreshDatabase;

    private function createPaidTransaction(): Transaction
    {
        $student = User::factory()->create();
        $tutor = User::factory()->create();
        $subject = Subject::create(['name' => 'Fisika', 'slug' => 'fisika']);

        $studyClass = StudyClass::create([
            'student_id' => $student->id,
            'tutor_id' => $tutor->id,
            'subject_id' => $subject->id,
            'status' => StudyClassStatus::PENDING,
            'metode_belajar' => 'online',
            'paket_mengajar' => '4x Pertemuan',
            'progress_percentage' => 0,
        ]);

        return Transaction::create([
            'study_class_id' => $studyClass->id,
            'amount' => 400000,
            'status' => TransactionStatus::PENDING,
        ]);
    }

    private function generateSignature(string $orderId, string $statusCode, string $grossAmount): string
    {
        $serverKey = config('midtrans.server_key');
        return hash('sha512', $orderId . $statusCode . $grossAmount . $serverKey);
    }

    public function test_webhook_marks_transaction_as_paid_on_settlement(): void
    {
        $transaction = $this->createPaidTransaction();
        $orderId = 'LESGO-' . $transaction->id . '-' . time();
        $signature = $this->generateSignature($orderId, '200', '400000.00');

        $response = $this->postJson('/api/midtrans/webhook', [
            'order_id' => $orderId,
            'status_code' => '200',
            'gross_amount' => '400000.00',
            'signature_key' => $signature,
            'transaction_status' => 'settlement',
            'payment_type' => 'bank_transfer',
        ]);

        $response->assertStatus(200);
        $this->assertDatabaseHas('transactions', [
            'id' => $transaction->id,
            'status' => TransactionStatus::PAID->value,
        ]);
    }

    public function test_webhook_rejects_invalid_signature(): void
    {
        $transaction = $this->createPaidTransaction();
        $orderId = 'LESGO-' . $transaction->id . '-' . time();

        $response = $this->postJson('/api/midtrans/webhook', [
            'order_id' => $orderId,
            'status_code' => '200',
            'gross_amount' => '400000.00',
            'signature_key' => 'invalid-signature',
            'transaction_status' => 'settlement',
            'payment_type' => 'bank_transfer',
        ]);

        $response->assertStatus(403);
        // Transaksi harus tetap pending
        $this->assertDatabaseHas('transactions', [
            'id' => $transaction->id,
            'status' => TransactionStatus::PENDING->value,
        ]);
    }

    public function test_webhook_is_idempotent_for_already_paid(): void
    {
        $transaction = $this->createPaidTransaction();
        $transaction->update([
            'status' => TransactionStatus::PAID,
            'paid_at' => now(),
        ]);

        $orderId = 'LESGO-' . $transaction->id . '-' . time();
        $signature = $this->generateSignature($orderId, '200', '400000.00');

        $response = $this->postJson('/api/midtrans/webhook', [
            'order_id' => $orderId,
            'status_code' => '200',
            'gross_amount' => '400000.00',
            'signature_key' => $signature,
            'transaction_status' => 'settlement',
            'payment_type' => 'bank_transfer',
        ]);

        $response->assertStatus(200);
        $response->assertJson(['message' => 'Transaction already processed']);
    }

    public function test_webhook_marks_transaction_as_failed_on_deny(): void
    {
        $transaction = $this->createPaidTransaction();
        $orderId = 'LESGO-' . $transaction->id . '-' . time();
        $signature = $this->generateSignature($orderId, '200', '400000.00');

        $response = $this->postJson('/api/midtrans/webhook', [
            'order_id' => $orderId,
            'status_code' => '200',
            'gross_amount' => '400000.00',
            'signature_key' => $signature,
            'transaction_status' => 'deny',
            'payment_type' => 'credit_card',
        ]);

        $response->assertStatus(200);
        $this->assertDatabaseHas('transactions', [
            'id' => $transaction->id,
            'status' => TransactionStatus::FAILED->value,
        ]);
    }
}
