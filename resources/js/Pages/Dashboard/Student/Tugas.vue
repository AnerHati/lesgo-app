<template>
          <div class="max-w-6xl mx-auto w-full space-y-5">
            <template v-if="tugasView === 'list'">
              <section class="bg-[#BFE4F8] rounded-xl border border-blue-100 p-6">
                <h2 class="text-4xl font-black text-gray-900">Tugas Saya</h2>
                <p class="text-sm text-gray-600 mt-2">Lihat dan selesaikan tugas - tugas yang diberikan tutor.</p>
                <p class="text-sm text-gray-600">Kamu memiliki {{ tugasBelumSelesaiCount }} tugas minggu ini.</p>
              </section>

              <section class="bg-white rounded-2xl border border-gray-200 shadow-sm p-4">
                <div class="flex items-center justify-between mb-4">
                  <div class="inline-flex rounded-lg bg-gray-100 p-1">
                    <button
                      v-for="tab in tugasTabs"
                      :key="tab.id"
                      type="button"
                      class="px-4 py-2 rounded-md text-sm font-bold transition"
                      :class="tugasFilter === tab.id
                        ? 'bg-[#2563EB] text-white'
                        : 'text-gray-600 hover:text-gray-800'"
                      @click="tugasFilter = tab.id"
                    >
                      {{ tab.label }}
                    </button>
                  </div>
                  <button
                    type="button"
                    class="w-9 h-9 rounded-lg border border-gray-200 bg-white text-gray-500 hover:bg-gray-50 flex items-center justify-center"
                    aria-label="Filter tugas"
                  >
                    ☰
                  </button>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                  <article
                    v-for="task in filteredTugasSaya"
                    :key="task.id"
                    class="rounded-xl border border-gray-200 p-4 shadow-sm"
                  >
                    <div class="flex items-start justify-between gap-3">
                      <div class="flex items-start gap-3 min-w-0">
                        <div class="w-11 h-11 rounded-xl bg-blue-50 flex items-center justify-center text-xl shrink-0">{{ task.icon }}</div>
                        <div class="min-w-0">
                          <h4 class="text-lg font-black text-[#2563EB] leading-tight">{{ task.title }}</h4>
                          <p class="text-sm text-gray-500 mt-0.5">Tutor {{ task.tutor }}</p>
                          <p class="text-xs text-gray-400 mt-1">🕒 {{ task.schedule }}</p>
                        </div>
                      </div>
                      <span
                        class="text-[10px] font-bold px-2.5 py-1 rounded-full whitespace-nowrap"
                        :class="task.statusType === 'done'
                          ? 'bg-emerald-100 text-emerald-700'
                          : task.statusType === 'pending'
                            ? 'bg-amber-100 text-amber-700'
                            : 'bg-blue-100 text-blue-700'"
                      >
                        {{ task.statusLabel }}
                      </span>
                    </div>

                    <div class="mt-3 text-xs text-gray-500 bg-amber-50 border border-amber-100 rounded-lg px-3 py-2">
                      ⏰ {{ task.meta }}
                    </div>

                    <div class="mt-3 flex justify-end gap-2">
                      <button
                        type="button"
                        class="px-3 py-1.5 rounded-lg text-xs font-bold border border-blue-200 text-[#2563EB] hover:bg-blue-50"
                        @click="handleTaskAction(task, 'secondary')"
                      >
                        {{ task.secondaryAction }}
                      </button>
                      <button
                        type="button"
                        class="px-3 py-1.5 rounded-lg text-xs font-bold bg-[#2563EB] text-white hover:bg-blue-700"
                        @click="handleTaskAction(task, 'primary')"
                      >
                        {{ task.primaryAction }}
                      </button>
                    </div>
                  </article>
                </div>
              </section>
            </template>

            <template v-else-if="tugasView === 'answer'">
              <button
                type="button"
                class="inline-flex items-center gap-2 px-4 py-2 rounded-lg border border-gray-200 bg-white text-sm font-semibold text-gray-700 hover:bg-gray-50"
                @click="goBackToTugasList"
              >
                <span aria-hidden="true">←</span>
                Kembali
              </button>

              <section class="bg-[#BFE4F8] rounded-xl border border-blue-100 p-5">
                <h3 class="text-3xl font-black text-gray-800">{{ selectedTugas?.title }}</h3>
                <p class="text-sm text-gray-700 mt-1">{{ selectedTugas?.subject }}</p>
                <p class="text-xs text-gray-500 mt-3">👤 Tutor {{ selectedTugas?.tutor }}</p>
              </section>

              <section class="bg-white rounded-2xl border border-gray-200 shadow-sm p-5 space-y-4">
                <div class="rounded-xl border border-emerald-200 bg-emerald-50 p-4">
                  <p class="font-bold text-emerald-700">Selamat! Jawaban kamu sudah berhasil dikumpulkan.</p>
                  <p class="text-sm text-emerald-700 mt-1">Waktu dikumpulkan: {{ selectedTugas?.submittedAt || '-' }}</p>
                </div>

                <article class="rounded-xl border border-gray-200 p-4 bg-gray-50/60">
                  <h4 class="font-bold text-gray-800">Ringkasan Jawaban Kamu</h4>
                  <p class="text-sm text-gray-600 mt-2 whitespace-pre-line">{{ selectedTugas?.answerContent || 'Belum ada jawaban.' }}</p>
                </article>

                <div class="flex justify-end">
                  <button
                    type="button"
                    class="px-4 py-2 rounded-lg text-sm font-bold bg-[#2563EB] text-white hover:bg-blue-700"
                    @click="downloadJawaban"
                  >
                    Download Jawaban
                  </button>
                </div>
              </section>

              <section class="bg-white rounded-2xl border border-gray-200 shadow-sm p-5 space-y-3">
                <h4 class="font-bold text-gray-800">Komentar</h4>
                <div class="space-y-2">
                  <article
                    v-for="comment in selectedTugasComments"
                    :key="comment.id"
                    class="rounded-lg border border-gray-200 p-3"
                  >
                    <p class="text-xs text-gray-500">{{ comment.author }} • {{ comment.time }}</p>
                    <p class="text-sm text-gray-700 mt-1">{{ comment.message }}</p>
                  </article>
                </div>

                <form class="pt-2 space-y-2" @submit.prevent="submitKomentar">
                  <textarea
                    v-model="newKomentar"
                    rows="3"
                    placeholder="Tulis komentar kamu..."
                    class="w-full rounded-lg border border-gray-200 px-3 py-2 text-sm focus:border-blue-400 focus:ring-blue-100"
                  />
                  <div class="flex justify-end">
                    <button
                      type="submit"
                      class="px-4 py-2 rounded-lg text-sm font-bold bg-[#1A56DB] text-white hover:bg-blue-700"
                    >
                      Tambah Komentar
                    </button>
                  </div>
                </form>
              </section>
            </template>

            <template v-else-if="tugasView === 'detail'">
              <button
                type="button"
                class="inline-flex items-center gap-2 px-4 py-2 rounded-lg border border-gray-200 bg-white text-sm font-semibold text-gray-700 hover:bg-gray-50"
                @click="goBackToTugasList"
              >
                <span aria-hidden="true">←</span>
                Kembali
              </button>

              <section class="bg-[#BFE4F8] rounded-xl border border-blue-100 p-5 flex items-start justify-between gap-4">
                <div class="flex items-start gap-4">
                  <div class="w-12 h-12 rounded-xl bg-white/80 flex items-center justify-center text-2xl">{{ selectedTugas?.icon }}</div>
                  <div>
                    <h3 class="text-3xl font-black text-gray-800 leading-tight">{{ selectedTugas?.title }}</h3>
                    <p class="text-gray-700 font-medium">{{ selectedTugas?.subject }}</p>
                    <p class="text-xs text-gray-500 mt-4">👤 Tutor {{ selectedTugas?.tutor }}</p>
                  </div>
                </div>
              </section>

              <section class="bg-white rounded-2xl border border-gray-200 shadow-sm p-5">
                <p class="text-sm text-gray-700 leading-relaxed">
                  {{ selectedTugas?.detailDescription }}
                </p>
                <ul class="mt-4 space-y-1.5 text-sm text-gray-600 list-disc pl-5">
                  <li v-for="(point, idx) in selectedTugas?.detailRules" :key="idx">{{ point }}</li>
                </ul>

                <div class="mt-4 space-y-1 text-xs font-semibold text-blue-600">
                  <p>🔵 Total {{ selectedTugas?.quizTotalSoal }} soal</p>
                  <p>🔵 Durasi {{ selectedTugas?.quizDurasi }}</p>
                  <p>🔵 Skor minimal {{ selectedTugas?.quizSkorMinimal }}</p>
                </div>

                <div class="mt-5 flex justify-end">
                  <button
                    type="button"
                    class="px-5 py-2.5 rounded-lg text-sm font-bold bg-[#2563EB] text-white hover:bg-blue-700"
                    @click="startQuizFromTask"
                  >
                    {{ selectedTugas?.primaryAction || 'Mulai' }}
                  </button>
                </div>
              </section>
            </template>

            <template v-else>
              <button
                type="button"
                class="inline-flex items-center gap-2 px-4 py-2 rounded-lg border border-gray-200 bg-white text-sm font-semibold text-gray-700 hover:bg-gray-50"
                @click="tugasView = 'detail'"
              >
                <span aria-hidden="true">←</span>
                Kembali ke detail tugas
              </button>

              <section class="bg-white rounded-2xl border border-gray-200 shadow-sm p-5 space-y-5">
                <div class="flex items-center justify-between">
                  <div>
                    <h3 class="text-xl font-black text-gray-900">{{ selectedTugas?.title }}</h3>
                    <p class="text-sm text-gray-500">Soal {{ currentQuestionNumber }} dari {{ quizQuestions.length }}</p>
                  </div>
                  <div class="px-3 py-1.5 rounded-lg bg-amber-50 text-amber-700 text-sm font-bold">
                    ⏱ {{ formattedQuizTime }}
                  </div>
                </div>

                <div class="w-full h-2 rounded-full bg-gray-100 overflow-hidden">
                  <div class="h-full bg-[#2563EB] transition-all" :style="{ width: `${quizProgress}%` }" />
                </div>

                <article class="rounded-xl border border-gray-200 p-4">
                  <h4 class="font-bold text-gray-800">{{ currentQuestion?.question }}</h4>
                  <div class="mt-4 space-y-2">
                    <label
                      v-for="option in currentQuestion?.options || []"
                      :key="option.value"
                      class="flex items-center gap-3 rounded-lg border border-gray-200 px-3 py-2 cursor-pointer hover:border-blue-300"
                      :class="currentAnswer === option.value ? 'bg-blue-50 border-blue-300' : ''"
                    >
                      <input
                        type="radio"
                        :name="`question-${currentQuestion?.id}`"
                        :value="option.value"
                        :checked="currentAnswer === option.value"
                        class="text-blue-600 focus:ring-blue-300"
                        @change="selectAnswer(option.value)"
                      >
                      <span class="text-sm text-gray-700">{{ option.label }}</span>
                    </label>
                  </div>
                </article>

                <div class="flex items-center justify-between">
                  <button
                    type="button"
                    class="px-4 py-2 rounded-lg text-sm font-bold border border-gray-300 text-gray-600 disabled:opacity-50"
                    :disabled="quizIndex === 0"
                    @click="goPrevQuestion"
                  >
                    Sebelumnya
                  </button>
                  <button
                    v-if="quizIndex < quizQuestions.length - 1"
                    type="button"
                    class="px-4 py-2 rounded-lg text-sm font-bold bg-[#2563EB] text-white hover:bg-blue-700"
                    @click="goNextQuestion"
                  >
                    Soal Berikutnya
                  </button>
                  <button
                    v-else
                    type="button"
                    class="px-4 py-2 rounded-lg text-sm font-bold bg-emerald-600 text-white hover:bg-emerald-700"
                    @click="submitQuiz"
                  >
                    Selesai & Kumpulkan
                  </button>
                </div>
              </section>
            </template>
          </div>
</template>

<script setup>
import { computed, onBeforeUnmount, ref } from 'vue'

const props = defineProps({
  tugas: { type: Array, default: () => [] }
})
const isQuizLoading = ref(false);
const quizResult = ref(null);
const tugasView = ref('list')
const selectedTugas = ref(null)
const newKomentar = ref('')
const quizIndex = ref(0)
const quizAnswers = ref({})
const quizRemainingSeconds = ref(10 * 60)
const quizSubmitted = ref(false)
let quizTimerId = null
const tugasFilter = ref('semua')
const tugasTabs = [
  { id: 'semua', label: 'Semua' },
  { id: 'belum', label: 'Belum Selesai' },
  { id: 'selesai', label: 'Selesai' },
  
]

const tugasSayaItems = computed(() => {
  if (!props.tugas) return [];
  return props.tugas.map(t => {
      let statusType = t.status === 'completed' || t.status === 'done' ? 'done' : 'pending';
      let statusLabel = statusType === 'done' ? 'Sudah Dikumpulkan' : 'Belum Selesai';
      let primaryAction = statusType === 'done' ? 'Lihat Jawaban' : 'Kumpulkan';
      let scheduleStr = t.study_class?.schedules && t.study_class.schedules.length > 0 
          ? new Date(t.study_class.schedules[0].start_time).toLocaleDateString('id-ID', { weekday: 'long', day: 'numeric', month: 'short' })
          : 'Belum dijadwalkan';
          
      return {
          id: t.id,
          title: t.title || 'Tugas Tanpa Judul',
          subject: t.study_class?.subject?.name || 'Mata Pelajaran',
          tutor: t.study_class?.tutor?.name || 'Tutor',
          schedule: scheduleStr,
          icon: t.study_class?.subject?.icon || '📝',
          statusType: statusType,
          statusLabel: statusLabel,
          meta: `Batas Waktu: ${t.deadline ? new Date(t.deadline).toLocaleString('id-ID') : '-'}`,
          primaryAction: primaryAction,
          secondaryAction: 'Lihat Tugas',
          detailDescription: t.description || 'Selesaikan tugas ini sesuai instruksi tutor.',
          detailRules: ['Kerjakan secara mandiri', 'Kumpulkan sebelum batas waktu'],
          quizTotalSoal: 10,
          quizDurasi: '10 menit',
          quizSkorMinimal: '70/100',
          submittedAt: null,
          answerContent: ''
      }
  });
});

const komentarTugas = ref({
  4: [{ id: 1, author: 'Tutor John Doe', time: '17 Mei 2026, 20:01', message: 'Bagus, grammar kamu sudah rapi. Tetap latihan ya.' }],
  5: [{ id: 1, author: 'Tutor Nadriin', time: '15 Mei 2026, 21:10', message: 'UI kamu clean, tinggal perbaiki spacing pada card kedua.' }],
})

const tugasBelumSelesaiCount = computed(() => tugasSayaItems.value.filter((t) => t.statusType === 'pending').length)
const filteredTugasSaya = computed(() => {
  if (tugasFilter.value === 'belum') return tugasSayaItems.value.filter((t) => t.statusType === 'pending')
  if (tugasFilter.value === 'selesai') return tugasSayaItems.value.filter((t) => t.statusType === 'done')
  return tugasSayaItems.value
})

const quizQuestions = ref([])

const currentQuestion = computed(() => quizQuestions.value[quizIndex.value] ?? null)
const currentQuestionNumber = computed(() => quizIndex.value + 1)
const currentAnswer = computed(() => quizAnswers.value[currentQuestion.value?.id] ?? null)
const quizProgress = computed(() => ((quizIndex.value + 1) / quizQuestions.value.length) * 100)
const formattedQuizTime = computed(() => {
  const m = String(Math.floor(quizRemainingSeconds.value / 60)).padStart(2, '0')
  const s = String(quizRemainingSeconds.value % 60).padStart(2, '0')
  return `${m}:${s}`
})
const selectedTugasComments = computed(() => {
  if (!selectedTugas.value?.id) return []
  return komentarTugas.value[selectedTugas.value.id] ?? []
})

function openTugasDetail(task) { selectedTugas.value = task; newKomentar.value = ''; stopQuizTimer(); tugasView.value = 'detail' }
function handleTaskAction(task, actionType) {
  const actionText = actionType === 'primary' ? task.primaryAction : task.secondaryAction
  if (String(actionText).toLowerCase().includes('jawaban')) { openJawabanTugas(task); return }
  openTugasDetail(task)
}
function goBackToTugasList() { stopQuizTimer(); tugasView.value = 'list' }
function openJawabanTugas(task) { selectedTugas.value = task; newKomentar.value = ''; stopQuizTimer(); tugasView.value = 'answer' }
function submitKomentar() {
  if (!selectedTugas.value?.id || !newKomentar.value.trim()) return
  const current = komentarTugas.value[selectedTugas.value.id] ?? []
  komentarTugas.value = { ...komentarTugas.value, [selectedTugas.value.id]: [...current, { id: Date.now(), author: 'Kenzo Aliza', time: new Date().toLocaleString('id-ID'), message: newKomentar.value.trim() }] }
  newKomentar.value = ''
}
function downloadJawaban() {
  if (!selectedTugas.value) return
  const content = [`Judul Tugas: ${selectedTugas.value.title}`, `Mapel: ${selectedTugas.value.subject}`, `Tutor: ${selectedTugas.value.tutor}`, `Waktu Dikumpulkan: ${selectedTugas.value.submittedAt || '-'}`, '', 'Jawaban:', selectedTugas.value.answerContent || '-'].join('\n')
  const blob = new Blob([content], { type: 'text/plain;charset=utf-8' })
  const url = URL.createObjectURL(blob)
  const link = document.createElement('a'); link.href = url; link.download = `jawaban-${String(selectedTugas.value.title).toLowerCase().replace(/\s+/g, '-')}.txt`
  document.body.appendChild(link); link.click(); document.body.removeChild(link); URL.revokeObjectURL(url)
}
function selectAnswer(value) { if (!currentQuestion.value) return; quizAnswers.value = { ...quizAnswers.value, [currentQuestion.value.id]: value } }
function goNextQuestion() { if (quizIndex.value < quizQuestions.value.length - 1) quizIndex.value += 1 }
function goPrevQuestion() { if (quizIndex.value > 0) quizIndex.value -= 1 }
function stopQuizTimer() { if (quizTimerId) { clearInterval(quizTimerId); quizTimerId = null } }
async function submitQuiz() { 
  stopQuizTimer(); 
  
  try {
    // Kirim data jawaban ke backend
    const res = await window.axios.post(`/api/tasks/${selectedTugas.value.id}/submit`, {
      answers: quizAnswers.value // Format: { question_id: option_id }
    });

    quizResult.value = res.data; // Menyimpan respons skor dari backend
    quizSubmitted.value = true;
    
    // Tampilkan hasil dan kembali ke daftar (atau ubah ke view hasil/answer)
    alert(`Skor Anda: ${res.data.score} (${res.data.correct_answers} benar dari ${res.data.total_questions} soal)`);
    tugasView.value = 'list';
    
  } catch (error) {
    console.error('Gagal mengirim jawaban:', error);
    alert(error.response?.data?.message || 'Gagal mengirim kuis.');
    tugasView.value = 'list';
  }
}

async function startQuizFromTask() {
  if (!selectedTugas.value) return;
  if (!String(selectedTugas.value.primaryAction).toLowerCase().includes('kuis')) return;
  
  isQuizLoading.value = true;
  quizIndex.value = 0; 
  quizAnswers.value = {}; 
  quizSubmitted.value = false;
  quizResult.value = null;
  tugasView.value = 'quiz';

  try {
    // Memanggil API backend untuk mendapatkan soal kuis
    const res = await window.axios.get(`/api/tasks/${selectedTugas.value.id}/quiz`);
    
    // Memetakan struktur soal dari database ke frontend
    quizQuestions.value = res.data.questions.map((q) => ({
      id: q.id,
      question: q.question,
      options: q.options.map((opt) => ({
        value: opt.id, // Kita pakai ID option sebagai value
        label: opt.value // Teks pilihan ganda A/B/C/D
      }))
    }));

    quizRemainingSeconds.value = 10 * 60; // Set timer 10 menit
    stopQuizTimer();
    quizTimerId = setInterval(() => { 
      if (quizRemainingSeconds.value <= 1) { 
        quizRemainingSeconds.value = 0; 
        submitQuiz(); 
        return; 
      }
      quizRemainingSeconds.value -= 1;
    }, 1000);

  } catch (error) {
    console.error('Gagal mengambil kuis:', error);
    alert('Terjadi kesalahan atau Anda sudah mengerjakan kuis ini.');
    tugasView.value = 'detail'; // kembali jika gagal
  } finally {
    isQuizLoading.value = false;
  }
}
onBeforeUnmount(() => { stopQuizTimer() })
</script>
