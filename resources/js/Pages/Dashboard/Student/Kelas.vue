<template>
          <div class="max-w-6xl mx-auto w-full">
            <template v-if="kelasView === 'list'">
              <div class="space-y-6">
                <div>
                  <h2 class="text-2xl font-black text-gray-900 tracking-tight">Kelas Saya</h2>
                  <p class="text-sm text-gray-500 font-medium mt-2">
                    Belajar makin konsisten, Kenzo! Kamu mengikuti
                    <span class="text-[#3B82F6] font-bold">{{ jumlahKelasAktifMingguIni }}</span>
                    kelas aktif minggu ini
                  </p>
                </div>

                <div class="flex flex-wrap items-center justify-between gap-4">
                  <div class="inline-flex rounded-xl bg-white p-1 border border-gray-100 shadow-sm">
                    <button
                      v-for="tab in kelasTabs"
                      :key="tab.id"
                      type="button"
                      class="px-5 py-2 rounded-lg text-sm font-bold transition"
                      :class="kelasFilter === tab.id
                        ? 'bg-[#3B82F6] text-white shadow-sm'
                        : 'text-gray-500 hover:text-gray-800'"
                      @click="kelasFilter = tab.id"
                    >
                      {{ tab.label }}
                    </button>
                  </div>
                  <button
                    type="button"
                    class="w-10 h-10 rounded-xl border border-gray-200 bg-white text-gray-500 hover:bg-gray-50 flex items-center justify-center shadow-sm"
                    aria-label="Filter kelas"
                  >
                    <span class="text-lg leading-none" aria-hidden="true">🎛️</span>
                  </button>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 pb-4">
                  <article
                    v-for="k in filteredKelas"
                    :key="k.id"
                    class="bg-white rounded-[28px] border border-gray-100 shadow-[0_8px_30px_rgb(0,0,0,0.06)] p-6 flex flex-col hover:-translate-y-1.5 hover:shadow-xl hover:shadow-blue-500/10 hover:border-blue-100 transition-all duration-300"
                    :class="kelasFilter === 'aktif' ? 'min-h-[190px]' : 'min-h-[220px]'"
                  >
                    <div class="flex justify-between items-start gap-3 mb-4">
                      <div class="flex gap-4 items-start min-w-0">
                        <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-blue-50 to-indigo-50 flex items-center justify-center text-3xl shrink-0">
                          {{ k.icon }}
                        </div>
                        <div class="min-w-0">
                          <h3 class="text-lg font-black text-[#3B82F6] leading-tight">{{ k.subject }}</h3>
                          <p class="text-sm text-gray-500 font-medium mt-1">{{ k.topic }}</p>
                        </div>
                      </div>
                      <span
                        v-if="k.status === 'upcoming'"
                        class="shrink-0 text-[10px] font-bold uppercase tracking-wide px-2.5 py-1 rounded-lg bg-amber-100 text-amber-800"
                      >
                        Mulai Minggu Depan
                      </span>
                      <span
                        v-else-if="k.status === 'active'"
                        class="shrink-0 text-[10px] font-bold uppercase tracking-wide px-2.5 py-1 rounded-lg bg-blue-100 text-blue-700"
                      >
                        Aktif
                      </span>
                      <span
                        v-else
                        class="shrink-0 text-[10px] font-bold uppercase tracking-wide px-2.5 py-1 rounded-lg bg-emerald-100 text-emerald-800"
                      >
                        Selesai
                      </span>
                    </div>

                    <div class="space-y-2 text-sm text-gray-500 font-medium mb-4">
                      <p class="flex items-center gap-2">
                        <span class="text-base opacity-70">👤</span>
                        Tutor {{ k.tutor }}
                      </p>
                      <p class="flex items-center gap-2">
                        <span class="text-base opacity-70">📅</span>
                        {{ k.schedule }}
                      </p>
                    </div>

                    <div v-if="k.status === 'active' || k.status === 'completed'" class="mb-4">
                      <div class="flex justify-between items-center text-[11px] font-bold text-gray-600 mb-1.5">
                        <span>Progres</span>
                        <span>{{ k.progress }}%</span>
                      </div>
                      <div class="h-2.5 rounded-full bg-gray-100 overflow-hidden">
                        <div
                          class="h-full rounded-full bg-gradient-to-r from-[#3B82F6] to-[#0EA5E9]"
                          :style="{ width: `${k.progress}%` }"
                        />
                      </div>
                    </div>

                    <div class="mt-auto pt-2 space-y-2">
                      <template v-if="k.status === 'upcoming'">
                        <button
                          type="button"
                          class="w-full py-3 rounded-xl font-bold text-sm border-2 border-[#3B82F6] text-[#3B82F6] hover:bg-blue-50 transition"
                        >
                          Lihat Jadwal
                        </button>
                      </template>
                      <template v-else-if="k.status === 'active'">
                        <button
                          type="button"
                          class="w-full py-3 rounded-xl font-bold text-sm shadow-md transition"
                          :class="k.subject === 'Bahasa Jepang'
                            ? 'bg-[#1A56DB] text-white hover:bg-blue-700'
                            : 'bg-gray-200 text-gray-500 cursor-not-allowed'"
                          :disabled="k.subject !== 'Bahasa Jepang'"
                          @click="k.subject === 'Bahasa Jepang' && openKelasMateri(k)"
                        >
                          {{ k.subject === 'Bahasa Jepang' ? 'Lihat Materi' : 'Materi Segera Hadir' }}
                        </button>
                      </template>
                      <template v-else>
                        <div class="grid grid-cols-2 gap-3">
                          <button
                            type="button"
                            @click="openReviewModal(k)"
                            class="py-3 rounded-xl font-bold text-sm bg-[#1A56DB] text-white hover:bg-blue-700 shadow-sm transition"
                          >
                            Review Materi
                          </button>
                          <button
                            type="button"
                            class="py-3 rounded-xl font-bold text-sm bg-[#1A56DB] text-white hover:bg-blue-700 shadow-sm transition"
                          >
                            Sertifikat
                          </button>
                        </div>
                      </template>
                      
                      <button 
                        v-if="k.canRefund"
                        @click="ajukanRefund(k)"
                        class="w-full py-2 rounded-xl font-bold text-xs text-red-500 hover:bg-red-50 border border-transparent hover:border-red-100 transition"
                      >
                        Batalkan & Ajukan Refund
                      </button>
                    </div>
                  </article>
                </div>
              </div>
            </template>

            <template v-else-if="kelasView === 'materi'">
              <div class="space-y-4">
                <button
                  type="button"
                  class="inline-flex items-center gap-2 px-4 py-2 rounded-lg border border-gray-200 bg-white text-sm font-semibold text-gray-700 hover:bg-gray-50"
                  @click="goBackToKelasList"
                >
                  <span aria-hidden="true">←</span>
                  Kembali
                </button>

                <section class="bg-[#BFE4F8] rounded-xl border border-blue-100 p-5 flex items-start justify-between gap-4">
                  <div class="flex items-start gap-4">
                    <div class="w-12 h-12 rounded-xl bg-white/80 flex items-center justify-center text-2xl">{{ selectedKelas?.icon }}</div>
                    <div>
                      <h3 class="text-3xl font-black text-gray-800 leading-tight">{{ selectedKelas?.subject }}</h3>
                      <p class="text-gray-700 font-medium">{{ selectedKelas?.topic }}</p>
                      <p class="text-xs text-gray-500 mt-4">👤 Tutor {{ selectedKelas?.tutor }}</p>
                    </div>
                  </div>
                </section>

                <section class="bg-white rounded-2xl border border-gray-200 shadow-sm">
                  <div class="px-4 pt-4 border-b border-gray-100">
                    <div class="inline-flex rounded-lg bg-gray-100 p-1">
                      <button
                        type="button"
                        class="px-4 py-2 rounded-md text-sm font-bold transition"
                        :class="kelasMateriTab === 'materi'
                          ? 'bg-[#2563EB] text-white'
                          : 'text-gray-500 hover:text-gray-700'"
                        @click="kelasMateriTab = 'materi'"
                      >
                        Materi
                      </button>
                      <button
                        type="button"
                        class="px-4 py-2 rounded-md text-sm font-bold transition"
                        :class="kelasMateriTab === 'tugas'
                          ? 'bg-[#2563EB] text-white'
                          : 'text-gray-500 hover:text-gray-700'"
                        @click="kelasMateriTab = 'tugas'"
                      >
                        Tugas ({{ japaneseTasks.length }})
                      </button>
                    </div>
                  </div>

                  <div v-if="kelasMateriTab === 'materi'" class="p-4 space-y-3">
                    <div class="flex flex-wrap items-start justify-between gap-3">
                      <h4 class="text-4xl font-black text-gray-800">Materi Pembelajaran</h4>
                      <button
                        v-if="canCreateMaterial"
                        type="button"
                        class="px-4 py-2 rounded-lg text-sm font-bold bg-[#2563EB] text-white hover:bg-blue-700 transition"
                        @click="showCreateMaterialForm = !showCreateMaterialForm"
                      >
                        {{ showCreateMaterialForm ? 'Tutup Form' : '+ Tambah Materi' }}
                      </button>
                    </div>

                    <form
                      v-if="showCreateMaterialForm"
                      class="rounded-xl border border-blue-200 bg-blue-50/50 p-4 space-y-3"
                      @submit.prevent="submitCreateMaterial"
                    >
                      <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                        <div>
                          <label class="text-xs font-bold text-gray-600">Judul Materi</label>
                          <input
                            v-model="newMaterialForm.title"
                            type="text"
                            placeholder="Contoh: Huruf Baris N"
                            class="mt-1 w-full rounded-lg border border-gray-200 px-3 py-2 text-sm focus:border-blue-400 focus:ring-blue-100"
                          >
                        </div>
                        <div>
                          <label class="text-xs font-bold text-gray-600">Status</label>
                          <select
                            v-model="newMaterialForm.status"
                            class="mt-1 w-full rounded-lg border border-gray-200 px-3 py-2 text-sm focus:border-blue-400 focus:ring-blue-100"
                          >
                            <option value="locked">Terkunci</option>
                            <option value="active">Aktif</option>
                            <option value="completed">Selesai</option>
                          </select>
                        </div>
                      </div>
                      <div>
                        <label class="text-xs font-bold text-gray-600">Deskripsi Materi</label>
                        <textarea
                          v-model="newMaterialForm.description"
                          rows="3"
                          placeholder="Deskripsi singkat materi..."
                          class="mt-1 w-full rounded-lg border border-gray-200 px-3 py-2 text-sm focus:border-blue-400 focus:ring-blue-100"
                        />
                      </div>
                      <p v-if="createMaterialError" class="text-sm font-semibold text-red-500">{{ createMaterialError }}</p>
                      <p v-if="createMaterialSuccess" class="text-sm font-semibold text-emerald-600">{{ createMaterialSuccess }}</p>
                      <button
                        type="submit"
                        class="px-4 py-2 rounded-lg text-sm font-bold bg-[#1A56DB] text-white disabled:opacity-60"
                        :disabled="isCreatingMaterial"
                      >
                        {{ isCreatingMaterial ? 'Menyimpan...' : 'Simpan Materi + Generate Tugas' }}
                      </button>
                    </form>

                    <article
                      v-for="item in japaneseMaterials"
                      :key="item.id"
                      class="rounded-xl border border-gray-200 p-4 flex items-center justify-between gap-4 transition"
                      :class="item.status !== 'locked' ? 'cursor-pointer hover:border-blue-200 hover:bg-blue-50/40' : 'opacity-85'"
                      @click="item.status !== 'locked' && openMateriDetail(item)"
                    >
                      <div class="flex items-start gap-3 min-w-0">
                        <div
                          class="w-8 h-8 rounded-full flex items-center justify-center text-xs font-black shrink-0"
                          :class="item.isCurrent
                            ? 'bg-blue-500 text-white'
                            : 'bg-gray-200 text-gray-500'"
                        >
                          {{ item.order }}
                        </div>
                        <div class="min-w-0">
                          <h5 class="text-2xl font-black text-gray-800">{{ item.title }}</h5>
                          <p class="text-sm text-gray-500 mt-1">{{ item.description }}</p>
                        </div>
                      </div>
                      <button
                        v-if="item.status !== 'locked'"
                        type="button"
                        class="text-xs font-bold px-3 py-1.5 rounded-full bg-emerald-50 text-emerald-600"
                      >
                        ✔ Selesai
                      </button>
                      <span
                        v-else
                        class="text-xs font-bold px-3 py-1.5 rounded-full bg-gray-100 text-gray-500"
                      >
                        🔒 Terkunci
                      </span>
                    </article>
                  </div>

                  <div v-else class="p-4 space-y-3">
                    <h4 class="text-4xl font-black text-gray-800">Materi Pembelajaran</h4>
                    <article
                      v-for="task in japaneseTasks"
                      :key="task.id"
                      class="rounded-xl border border-gray-200 p-4 flex items-center justify-between gap-4"
                    >
                      <div class="flex items-start gap-3 min-w-0">
                        <div class="w-8 h-8 rounded-full bg-blue-500 text-white flex items-center justify-center text-xs font-black shrink-0">
                          {{ task.order }}
                        </div>
                        <div class="min-w-0">
                          <h5 class="text-2xl font-black text-gray-800">{{ task.title }}</h5>
                          <p class="text-sm text-gray-500 mt-1">{{ task.description }}</p>
                          <p class="text-xs text-gray-400 mt-1">⏱ Batas Waktu: {{ task.deadline }}</p>
                        </div>
                      </div>
                      <div class="flex flex-col items-end gap-2 shrink-0">
                        <span
                          class="text-xs font-bold px-3 py-1.5 rounded-full"
                          :class="task.statusType === 'done'
                            ? 'bg-emerald-50 text-emerald-600'
                            : task.statusType === 'pending'
                              ? 'bg-amber-50 text-amber-500'
                              : 'bg-red-50 text-red-500'"
                        >
                          {{ task.statusLabel }}
                        </span>
                        <button
                          v-if="task.action"
                          type="button"
                          class="px-3 py-1.5 rounded-lg text-xs font-bold bg-[#2563EB] text-white hover:bg-blue-700 transition"
                        >
                          {{ task.action }}
                        </button>
                      </div>
                    </article>
                  </div>
                </section>
              </div>
            </template>

            <template v-else>
              <div class="space-y-4">
                <button
                  type="button"
                  class="inline-flex items-center gap-2 px-4 py-2 rounded-lg border border-gray-200 bg-white text-sm font-semibold text-gray-700 hover:bg-gray-50"
                  @click="goBackToMateriList"
                >
                  <span aria-hidden="true">←</span>
                  Kembali ke kelas
                </button>

                <section class="bg-[#BFE4F8] rounded-xl border border-blue-100 p-5 flex items-start justify-between gap-4">
                  <div class="flex items-start gap-4">
                    <div class="w-12 h-12 rounded-xl bg-white/80 flex items-center justify-center text-2xl">{{ selectedKelas?.icon }}</div>
                    <div>
                      <h3 class="text-3xl font-black text-gray-800 leading-tight">{{ selectedLesson?.title }}</h3>
                      <p class="text-gray-700 font-medium">{{ selectedKelas?.subject }}</p>
                      <p class="text-xs text-gray-500 mt-4">👤 Tutor {{ selectedKelas?.tutor }}</p>
                    </div>
                  </div>
                </section>

                <section class="bg-white rounded-2xl border border-gray-200 shadow-sm p-6 space-y-4">
                  <div v-if="isLoadingMaterials" class="text-center text-gray-500 py-10 font-bold">
                    Sedang memuat materi...
                  </div>
                  
                  <div v-else-if="selectedLesson?.content">
                    <div class="prose max-w-none text-gray-700 leading-relaxed" v-html="selectedLesson.content"></div>
                  </div>
                  
                  <div v-else class="text-center text-gray-500 py-10">
                    <span class="text-4xl mb-3 block opacity-50">📄</span>
                    <p class="font-bold text-lg">Materi belum memiliki konten</p>
                    <p class="text-sm mt-1">Tutor belum mengunggah konten detail untuk materi ini.</p>
                  </div>
                </section>
              </div>
            </template>
          </div>

          <!-- Review Modal -->
          <div v-if="isReviewModalOpen" class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 p-4">
            <div class="bg-white rounded-2xl w-full max-w-md p-6 shadow-xl">
              <h3 class="text-xl font-black text-gray-900 mb-4">Review Tutor & Materi</h3>
              
              <div v-if="selectedClassForReview" class="mb-4">
                <p class="text-sm text-gray-500 font-medium">Tutor: <span class="text-gray-800 font-bold">{{ selectedClassForReview.tutor }}</span></p>
                <p class="text-sm text-gray-500 font-medium">Kelas: <span class="text-gray-800 font-bold">{{ selectedClassForReview.subject }}</span></p>
              </div>

              <div class="space-y-4">
                <div>
                  <label class="block text-sm font-bold text-gray-700 mb-1">Rating (1-5)</label>
                  <div class="flex gap-2">
                    <button 
                      v-for="star in 5" 
                      :key="star"
                      type="button"
                      @click="reviewForm.rating = star"
                      class="text-3xl focus:outline-none transition-transform hover:scale-110"
                      :class="star <= reviewForm.rating ? 'text-amber-400' : 'text-gray-200'"
                    >
                      ★
                    </button>
                  </div>
                </div>

                <div>
                  <label class="block text-sm font-bold text-gray-700 mb-1">Ulasan (Opsional)</label>
                  <textarea 
                    v-model="reviewForm.comment"
                    rows="3" 
                    placeholder="Bagaimana pengalaman belajarmu?"
                    class="w-full rounded-xl border border-gray-200 px-4 py-2 text-sm focus:border-blue-400 focus:ring-blue-100"
                  ></textarea>
                </div>
              </div>

              <div class="flex justify-end gap-3 mt-6">
                <button 
                  type="button" 
                  @click="closeReviewModal"
                  class="px-4 py-2 rounded-xl text-sm font-bold text-gray-600 bg-gray-100 hover:bg-gray-200"
                >
                  Batal
                </button>
                <button 
                  type="button" 
                  @click="submitReview"
                  :disabled="isSubmittingReview"
                  class="px-4 py-2 rounded-xl text-sm font-bold text-white bg-[#2563EB] hover:bg-blue-700 disabled:opacity-70"
                >
                  {{ isSubmittingReview ? 'Menyimpan...' : 'Kirim Review' }}
                </button>
              </div>
            </div>
          </div>
</template>

<script setup>
import { computed, ref } from 'vue'

const props = defineProps({
  japaneseClassData: { type: Object, default: null },
  kelas: { type: Array, default: () => [] },
})

const japaneseClassState = ref(props.japaneseClassData)
const kelasFilter = ref('semua')
const kelasView = ref('list')
const kelasMateriTab = ref('materi')
const selectedKelas = ref(null)
const selectedLesson = ref(null)
const showCreateMaterialForm = ref(false)
const isCreatingMaterial = ref(false)
const createMaterialError = ref('')
const createMaterialSuccess = ref('')
const newMaterialForm = ref({ title: '', description: '', status: 'locked' })

// Review Modal State
const isReviewModalOpen = ref(false)
const selectedClassForReview = ref(null)
const reviewForm = ref({ rating: 5, comment: '' })
const isSubmittingReview = ref(false)

function openReviewModal(kelas) {
    selectedClassForReview.value = kelas;
    reviewForm.value = { rating: 5, comment: '' };
    isReviewModalOpen.value = true;
}

function closeReviewModal() {
    isReviewModalOpen.value = false;
    selectedClassForReview.value = null;
}

async function submitReview() {
    if (!selectedClassForReview.value) return;
    
    isSubmittingReview.value = true;
    try {
        const res = await window.axios.post('/api/reviews', {
            study_class_id: selectedClassForReview.value.id,
            rating: reviewForm.value.rating,
            comment: reviewForm.value.comment
        });
        alert('Review berhasil dikirim!');
        closeReviewModal();
    } catch (err) {
        alert(err.response?.data?.message || 'Gagal mengirim review.');
    } finally {
        isSubmittingReview.value = false;
    }
}

const kelasTabs = [
  { id: 'semua', label: 'Semua' },
  { id: 'aktif', label: 'Aktif' },
  { id: 'selesai', label: 'Selesai' },
]

const kelasItems = computed(() => {
  if (!props.kelas) return [];
  return props.kelas.map(k => {
      // Find nearest schedule or first schedule
      let scheduleText = 'Belum dijadwalkan';
      let statusStr = k.status;
      let hasCompletedSchedule = false;
      if (k.schedules && k.schedules.length > 0) {
          const firstSch = k.schedules[0];
          const start = new Date(firstSch.start_time);
          const end = new Date(firstSch.end_time);
          const days = ['Minggu','Senin','Selasa','Rabu','Kamis','Jumat','Sabtu'];
          scheduleText = `${days[start.getDay()]}, ${start.getHours().toString().padStart(2,'0')}:${start.getMinutes().toString().padStart(2,'0')}-${end.getHours().toString().padStart(2,'0')}:${end.getMinutes().toString().padStart(2,'0')}`;
          
          if (start > new Date() && statusStr !== 'active') {
              statusStr = 'upcoming';
          }
          hasCompletedSchedule = k.schedules.some(s => s.status === 'completed');
      }

      let transaction = null;
      if (k.transactions && k.transactions.length > 0) {
          transaction = k.transactions.find(t => t.status === 'paid');
      }
      const canRefund = transaction && !hasCompletedSchedule && statusStr !== 'completed' && statusStr !== 'cancelled';

      return {
          id: k.id,
          subject: k.subject ? k.subject.name : 'Unknown',
          topic: k.paket_mengajar || 'Materi Umum',
          tutor: k.tutor ? k.tutor.name : 'Unknown',
          schedule: scheduleText,
          status: statusStr,
          icon: k.subject?.icon || '📚',
          progress: k.progress_percentage || 0,
          canRefund,
          transactionId: transaction?.id,
      }
  });
});

async function ajukanRefund(kelas) {
  if (confirm('Apakah Anda yakin ingin mengajukan refund untuk kelas ini? Aksi ini tidak dapat dibatalkan.')) {
    try {
      const res = await window.axios.post(`/api/payment/${kelas.transactionId}/refund`);
      alert('Berhasil: ' + res.data.message);
      window.location.reload();
    } catch (err) {
      alert('Gagal: ' + (err.response?.data?.message || 'Terjadi kesalahan saat mengajukan refund'));
    }
  }
}

const jumlahKelasAktifMingguIni = computed(() => kelasItems.value.filter((k) => k.status === 'active').length)

const filteredKelas = computed(() => {
  if (kelasFilter.value === 'aktif') return kelasItems.value.filter((k) => k.status === 'active' || k.status === 'upcoming')
  if (kelasFilter.value === 'selesai') return kelasItems.value.filter((k) => k.status === 'completed')
  return kelasItems.value
})



const japaneseMaterials = computed(() => {
  const source = japaneseClassState.value?.materials ?? [];
  if (!source.length) return [];
  
  return source.map((material, index) => ({
    id: material.id, 
    order: material.order_index ?? index + 1, 
    title: material.title,
    description: material.description || 'Belajar materi pelajaran ini.', 
    content: material.content,
    status: material.status || 'locked', 
    isCurrent: index === 0,
  }));
});

function getTaskStatusType(status) { if (status === 'done') return 'done'; if (status === 'late') return 'late'; return 'pending' }
function getTaskStatusLabel(st) { if (st === 'done') return '✔ Sudah Dikumpul'; if (st === 'late') return '◉ Terlambat'; return '◷ Belum Dikerjakan' }
function getTaskAction(st) { if (st === 'done') return 'Lihat Jawaban'; if (st === 'pending') return 'Kerjakan'; return '' }

const japaneseTasks = computed(() => {
  const source = japaneseClassState.value?.materials ?? [];
  if (!source.length) return [];
  
  return source.flatMap((material) =>
    (material.tasks ?? []).map((task, index) => {
      const statusType = getTaskStatusType(task.status);
      return { 
        id: task.id, 
        order: index + 1, 
        title: task.title, 
        description: task.description || `Tugas untuk materi ${material.title}`,
        deadline: task.deadline ? new Date(task.deadline).toLocaleString('id-ID') : '-', 
        statusType, 
        statusLabel: getTaskStatusLabel(statusType), 
        action: getTaskAction(statusType) 
      };
    })
  );
});

const canCreateMaterial = computed(() => Boolean(japaneseClassState.value?.id))

function resetCreateMaterialForm() { newMaterialForm.value = { title: '', description: '', status: 'locked' } }

async function submitCreateMaterial() {
  createMaterialError.value = ''; createMaterialSuccess.value = ''
  if (!newMaterialForm.value.title.trim()) { createMaterialError.value = 'Judul materi wajib diisi.'; return }
  if (!japaneseClassState.value?.id) { createMaterialError.value = 'Kelas Bahasa Jepang belum tersedia di database.'; return }
  isCreatingMaterial.value = true
  try {
    const response = await window.axios.post(`/study-classes/${japaneseClassState.value.id}/materials`, {
      title: newMaterialForm.value.title, description: newMaterialForm.value.description, status: newMaterialForm.value.status,
    })
    const createdMaterial = response?.data?.data
    if (createdMaterial) {
      const currentMaterials = japaneseClassState.value.materials ?? []
      japaneseClassState.value = { ...japaneseClassState.value, materials: [...currentMaterials, createdMaterial] }
      createMaterialSuccess.value = 'Materi berhasil ditambahkan beserta tugas default.'
      resetCreateMaterialForm()
    }
  } catch (error) { createMaterialError.value = error?.response?.data?.message ?? 'Gagal menambahkan materi.' }
  finally { isCreatingMaterial.value = false }
}



const isLoadingMaterials = ref(false)

async function openKelasMateri(kelas) { 
  selectedKelas.value = kelas; 
  kelasMateriTab.value = 'materi'; 
  kelasView.value = 'materi'; 
  
  japaneseClassState.value = null;
  isLoadingMaterials.value = true;
  
  try {
    const res = await window.axios.get(`/api/classes/${kelas.id}/materials`);
    japaneseClassState.value = {
      id: res.data.class.id,
      materials: res.data.materials
    };
    selectedLesson.value = japaneseMaterials.value[0] ?? null;
  } catch (e) {
    console.error("Gagal memuat materi kelas", e);
    alert("Gagal memuat materi. Pastikan Anda memiliki akses ke kelas ini.");
    kelasView.value = 'list';
  } finally {
    isLoadingMaterials.value = false;
  }
}
function openMateriDetail(materi) { selectedLesson.value = materi; kelasView.value = 'detail' }
function goBackToKelasList() { kelasView.value = 'list' }
function goBackToMateriList() { kelasView.value = 'materi' }
</script>
