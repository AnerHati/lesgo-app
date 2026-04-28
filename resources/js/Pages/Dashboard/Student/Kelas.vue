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

                    <div class="mt-auto pt-2">
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
                  <p class="text-gray-700 leading-relaxed">
                    Hiragana adalah salah satu dari tiga sistem penulisan bahasa Jepang (bersama Katakana dan Kanji)
                    yang terdiri dari 46 karakter dasar. Huruf ini bersifat fonetik, mewakili bunyi suku kata, dan
                    ditandai dengan bentuknya yang melengkung. Hiragana digunakan untuk menulis kata-kata asli Jepang,
                    partikel, serta okurigana.
                  </p>

                  <div>
                    <h4 class="text-2xl font-black text-gray-800">Huruf Dasar Hiragana</h4>
                    <p class="text-sm text-gray-500 mt-1">Berikut adalah huruf vokal dalam hiragana</p>
                  </div>

                  <div class="max-w-xl rounded-xl border border-amber-200 bg-[#FFF9EC] p-4">
                    <div class="text-center text-2xl font-black text-blue-700 mb-2">Hiragana Vowels 👶</div>
                    <div class="grid grid-cols-5 border border-amber-200 rounded-lg overflow-hidden text-center">
                      <div v-for="letter in hiraganaTable" :key="letter.romaji" class="p-3 bg-white border-r border-amber-200 last:border-r-0">
                        <p class="text-4xl font-bold text-blue-700">{{ letter.upper }}</p>
                        <p class="text-3xl text-blue-800 mt-1">{{ letter.char }}</p>
                        <p class="text-sm font-semibold text-gray-600 mt-1">{{ letter.romaji }}</p>
                      </div>
                    </div>
                  </div>

                  <div>
                    <h4 class="text-2xl font-black text-gray-800 mb-3">Tips Menghafal Huruf Dasar Hiragana</h4>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
                      <article
                        v-for="tip in learningTips"
                        :key="tip.id"
                        class="rounded-xl border border-blue-300 bg-[#F9FCFF] p-4"
                      >
                        <h5 class="text-lg font-black text-gray-800">{{ tip.title }}</h5>
                        <p class="text-sm text-gray-600 mt-1">{{ tip.description }}</p>
                      </article>
                    </div>
                  </div>
                </section>
              </div>
            </template>
          </div>
</template>

<script setup>
import { computed, ref } from 'vue'

const props = defineProps({
  japaneseClassData: { type: Object, default: null },
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

const kelasTabs = [
  { id: 'semua', label: 'Semua' },
  { id: 'aktif', label: 'Aktif' },
  { id: 'selesai', label: 'Selesai' },
]

const kelasItems = [
  { id: 1, subject: 'Informatika', topic: 'UI/UX Design', tutor: 'Ananta Aldora', schedule: 'Jumat, 15:00-17:30', status: 'upcoming', icon: '🖥️', progress: 0 },
  { id: 2, subject: 'Fisika', topic: 'Listrik dan Magnet', tutor: 'Yura Agustina', schedule: 'Rabu, 12:00-13:30', status: 'upcoming', icon: '🧲', progress: 0 },
  { id: 3, subject: 'Matematika', topic: 'Transformasi Geometri', tutor: 'Isyana Randini', schedule: 'Jumat, 15:00-17:30', status: 'active', icon: '📐', progress: 15 },
  { id: 4, subject: 'Bahasa Jepang', topic: 'Huruf Hiragana', tutor: 'Renata', schedule: 'Rabu, 12:00-13:30', status: 'active', icon: '🇯🇵', progress: 65 },
  { id: 13, subject: 'Bahasa Inggris', topic: 'Simple Present Tense', tutor: 'John Doe', schedule: 'Jumat, 17:00-18:30', status: 'active', icon: '🇬🇧', progress: 40 },
  { id: 14, subject: 'Bahasa Indonesia', topic: 'Paragraf Deduktif', tutor: 'Jonathan', schedule: 'Sabtu, 15:00-17:30', status: 'active', icon: '📚', progress: 95 },
  { id: 5, subject: 'Biologi', topic: 'Asam Nukleat', tutor: 'Oliver James', schedule: 'Senin, 10:00-11:30', status: 'completed', icon: '🧬', progress: 100 },
  { id: 6, subject: 'Kimia', topic: 'Reaksi Kimia', tutor: 'Oliver James', schedule: 'Selasa, 13:00-14:30', status: 'completed', icon: '🧪', progress: 100 },
  { id: 7, subject: 'Sejarah', topic: 'Sejarah Dunia Modern', tutor: 'Maria Santoso', schedule: 'Rabu, 09:00-10:30', status: 'completed', icon: '🌍', progress: 100 },
  { id: 8, subject: 'Matematika', topic: 'Bangun Ruang', tutor: 'Isyana Randini', schedule: 'Kamis, 15:00-16:30', status: 'completed', icon: '📦', progress: 100 },
  { id: 9, subject: 'Matematika', topic: 'Phytagoras', tutor: 'Budi Wijaya', schedule: 'Jumat, 08:00-09:30', status: 'completed', icon: '📏', progress: 100 },
  { id: 10, subject: 'Geografi', topic: 'Peta dan Pemetaan', tutor: 'Dewi Lestari', schedule: 'Sabtu, 10:00-11:30', status: 'completed', icon: '🗺️', progress: 100 },
  { id: 11, subject: 'Seni Budaya', topic: 'Seni Musik', tutor: 'Rina Kusuma', schedule: 'Minggu, 14:00-15:30', status: 'completed', icon: '🎵', progress: 100 },
  { id: 12, subject: 'Ekonomi', topic: 'Manajemen Keuangan', tutor: 'Andre Pratama', schedule: 'Senin, 15:00-16:30', status: 'completed', icon: '💹', progress: 100 },
]

const jumlahKelasAktifMingguIni = computed(() => kelasItems.filter((k) => k.status === 'active').length)

const filteredKelas = computed(() => {
  if (kelasFilter.value === 'aktif') return kelasItems.filter((k) => k.status === 'active')
  if (kelasFilter.value === 'selesai') return kelasItems.filter((k) => k.status === 'completed')
  return kelasItems
})

const fallbackJapaneseMaterials = [
  { id: 1, order: 1, title: 'Dasar Hiragana', description: 'Belajar dasar pengenalan huruf hiragana.', status: 'completed', isCurrent: true },
  { id: 2, order: 2, title: 'Huruf Baris K', description: 'Belajar dasar pengenalan huruf hiragana.', status: 'locked', isCurrent: false },
  { id: 3, order: 3, title: 'Huruf Baris S', description: 'Belajar dasar pengenalan huruf hiragana.', status: 'locked', isCurrent: false },
  { id: 4, order: 4, title: 'Huruf Baris T', description: 'Belajar dasar pengenalan huruf hiragana.', status: 'locked', isCurrent: false },
]

const fallbackJapaneseTasks = [
  { id: 1, order: 1, title: 'Tugas 1: Menulis Hiragana A-Ka', description: 'Tulislah di buku tulis, hiragana A-Ka', deadline: 'Ming, 20.00', statusType: 'done', statusLabel: '✔ Sudah Dikumpul', action: 'Lihat Jawaban' },
  { id: 2, order: 2, title: 'Tugas 2: Menulis Hiragana A-Sa', description: 'Tulislah di buku tulis, hiragana A-Ka', deadline: 'Ming, 20.00', statusType: 'pending', statusLabel: '◷ Belum Dikerjakan', action: 'Kerjakan' },
  { id: 3, order: 3, title: 'Tugas 3: Menulis Hiragana A-Sa', description: 'Tulislah di buku tulis, hiragana A-Ka', deadline: 'Ming, 20.00', statusType: 'late', statusLabel: '◉ Terlambat', action: '' },
]

const japaneseMaterials = computed(() => {
  const source = japaneseClassState.value?.materials ?? []
  if (!source.length) return fallbackJapaneseMaterials
  return source.map((material, index) => ({
    id: material.id, order: material.order_index ?? index + 1, title: material.title,
    description: material.description || 'Belajar materi bahasa Jepang.', status: material.status || 'locked', isCurrent: index === 0,
  }))
})

function getTaskStatusType(status) { if (status === 'done') return 'done'; if (status === 'late') return 'late'; return 'pending' }
function getTaskStatusLabel(st) { if (st === 'done') return '✔ Sudah Dikumpul'; if (st === 'late') return '◉ Terlambat'; return '◷ Belum Dikerjakan' }
function getTaskAction(st) { if (st === 'done') return 'Lihat Jawaban'; if (st === 'pending') return 'Kerjakan'; return '' }

const japaneseTasks = computed(() => {
  const source = japaneseClassState.value?.materials ?? []
  if (!source.length) return fallbackJapaneseTasks
  return source.flatMap((material) =>
    (material.tasks ?? []).map((task, index) => {
      const statusType = getTaskStatusType(task.status)
      return { id: task.id, order: index + 1, title: task.title, description: task.description || `Tugas untuk materi ${material.title}`,
        deadline: task.deadline ? new Date(task.deadline).toLocaleString('id-ID') : '-', statusType, statusLabel: getTaskStatusLabel(statusType), action: getTaskAction(statusType) }
    })
  )
})

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

const hiraganaTable = [
  { upper: 'A', char: 'あ', romaji: 'a' }, { upper: 'I', char: 'い', romaji: 'i' },
  { upper: 'U', char: 'う', romaji: 'u' }, { upper: 'E', char: 'え', romaji: 'e' }, { upper: 'O', char: 'お', romaji: 'o' },
]

const learningTips = [
  { id: 1, title: 'Ulangi dan Tulis', description: 'Tulis tiap huruf hingga terbiasa dengan bentuknya dan cara pengucapannya.' },
  { id: 2, title: 'Gunakan Kartu', description: 'Buat kartu huruf dan bacakan dengan suara nyaring untuk memperkuat ingatan.' },
  { id: 3, title: 'Bermain Quiz', description: 'Latih diri dengan kuis ringan agar hafalan lebih cepat dan menyenangkan.' },
]

function openKelasMateri(kelas) { selectedKelas.value = kelas; selectedLesson.value = japaneseMaterials.value[0] ?? null; kelasMateriTab.value = 'materi'; kelasView.value = 'materi' }
function openMateriDetail(materi) { selectedLesson.value = materi; kelasView.value = 'detail' }
function goBackToKelasList() { kelasView.value = 'list' }
function goBackToMateriList() { kelasView.value = 'materi' }
</script>
