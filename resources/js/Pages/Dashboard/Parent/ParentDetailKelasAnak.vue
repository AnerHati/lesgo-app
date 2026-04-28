<template>
  <div class="max-w-6xl mx-auto w-full animate-fade-in">
    <div class="space-y-4">
      <button
        v-if="detailView === 'materi_list'"
        type="button"
        class="inline-flex items-center gap-2 px-4 py-2 rounded-lg border border-gray-200 bg-white text-sm font-semibold text-gray-700 hover:bg-gray-50 transition"
        @click="$emit('navigate', 'kelas_anak')"
      >
        <span aria-hidden="true">←</span>
        Kembali
      </button>
      <button
        v-else-if="detailView === 'materi_detail'"
        type="button"
        class="inline-flex items-center gap-2 px-4 py-2 rounded-lg border border-gray-200 bg-white text-sm font-semibold text-gray-700 hover:bg-gray-50 transition"
        @click="detailView = 'materi_list'"
      >
        <span aria-hidden="true">←</span>
        Kembali ke kelas
      </button>

      <section class="bg-[#BFE4F8] rounded-xl border border-blue-100 p-5 flex items-start justify-between gap-4">
        <div class="flex items-start gap-4">
          <div class="w-12 h-12 rounded-xl bg-white/80 flex items-center justify-center text-3xl shadow-sm">🔠</div>
          <div>
            <h3 v-if="detailView === 'materi_list'" class="text-3xl font-black text-gray-800 leading-tight">Bahasa Jepang</h3>
            <h3 v-else class="text-3xl font-black text-gray-800 leading-tight">Materi Dasar Hiragana</h3>
            
            <p v-if="detailView === 'materi_list'" class="text-gray-700 font-medium mt-1">Huruf Hiragana</p>
            <p v-else class="text-gray-700 font-medium mt-1">Bahasa Jepang</p>
            
            <p class="text-xs text-gray-500 mt-4 flex items-center gap-1.5 font-semibold">
              <span class="text-gray-400">👤</span> Tutor Renata
            </p>
          </div>
        </div>
      </section>

      <template v-if="detailView === 'materi_list'">
        <section class="bg-white rounded-2xl border border-gray-200 shadow-sm">
          <div class="px-4 pt-4 border-b border-gray-100">
            <div class="inline-flex rounded-lg bg-gray-100 p-1">
              <button
                type="button"
                class="px-6 py-2 rounded-md text-sm font-bold transition shadow-sm"
                :class="activeTab === 'materi' ? 'bg-[#2563EB] text-white' : 'text-gray-500 hover:text-gray-700 hover:bg-white'"
                @click="activeTab = 'materi'"
              >
                Materi
              </button>
              <button
                type="button"
                class="px-6 py-2 rounded-md text-sm font-bold transition"
                :class="activeTab === 'tugas' ? 'bg-[#2563EB] text-white shadow-sm' : 'text-gray-500 hover:text-gray-700 hover:bg-white'"
                @click="activeTab = 'tugas'"
              >
                Tugas (3)
              </button>
            </div>
          </div>

          <div v-if="activeTab === 'materi'" class="p-6 space-y-4">
            <h4 class="text-2xl font-black text-gray-800 mb-2">Materi Pembelajaran</h4>
            
            <article
              v-for="(item, index) in materials"
              :key="item.id"
              class="rounded-2xl border border-gray-100 bg-white p-5 flex items-center justify-between gap-4 transition shadow-sm"
              :class="item.status === 'completed' ? 'cursor-pointer hover:border-blue-200 hover:shadow-md' : 'opacity-85'"
              @click="item.status === 'completed' ? detailView = 'materi_detail' : null"
            >
              <div class="flex items-start gap-4 min-w-0">
                <div
                  class="w-10 h-10 rounded-full flex items-center justify-center text-sm font-black shrink-0 border"
                  :class="item.status === 'completed' ? 'bg-blue-50 text-[#2563EB] border-blue-200' : 'bg-gray-100 text-gray-400 border-gray-200'"
                >
                  <span v-if="item.status === 'completed'">{{ index + 1 }}</span>
                  <span v-else class="text-xl">🛡️</span>
                </div>
                <div class="min-w-0 pt-0.5">
                  <h5 class="text-xl font-black text-gray-800">{{ item.title }}</h5>
                  <p class="text-sm text-gray-500 font-medium mt-1">{{ item.description }}</p>
                </div>
              </div>
              <div
                class="text-[11px] font-bold px-3 py-1.5 rounded-full flex items-center gap-1.5"
                :class="item.status === 'completed' ? 'bg-emerald-50 text-emerald-600 border border-emerald-100' : 'text-gray-400'"
              >
                <span v-if="item.status === 'completed'" class="text-sm">✔</span>
                <span v-else class="text-sm">🔒</span>
                {{ item.status === 'completed' ? 'Selesai' : 'Terkunci' }}
              </div>
            </article>
          </div>
          <div v-else class="p-6">
            <p class="text-gray-500 font-medium text-center py-8">Belum ada data tugas.</p>
          </div>
        </section>
      </template>

      <template v-else-if="detailView === 'materi_detail'">
        <section class="bg-white rounded-2xl border border-gray-200 shadow-sm p-8 space-y-8">
          <p class="text-gray-600 font-medium leading-relaxed">
            Hiragana adalah salah satu dari tiga sistem penulisan bahasa Jepang (bersama Katakana dan Kanji) yang terdiri dari 46 karakter dasar. Huruf ini bersifat fonetik, mewakili bunyi suku kata, dan ditandai dengan bentuknya yang melengkung. Hiragana digunakan untuk menulis kata-kata asli Jepang, partikel, serta okurigana (akhiran kata kerja/sifat).
          </p>

          <div>
            <h4 class="text-2xl font-black text-gray-900 mb-1">Huruf Dasar Hiragana</h4>
            <p class="text-sm font-medium text-gray-500 mb-4">Berikut adalah huruf vokal dalam hiragana</p>
            
            <div class="max-w-xl rounded-[24px] border border-amber-200/60 bg-[#FFFDF5] p-5">
              <div class="text-center text-xl font-black text-blue-500 mb-4 flex items-center justify-center gap-2">
                <span class="bg-blue-100 text-blue-600 px-4 py-1.5 rounded-full">Hiragana Vowels 🐣</span>
              </div>
              <div class="grid grid-cols-5 border-2 border-amber-200/60 rounded-xl overflow-hidden bg-white shadow-sm">
                <div v-for="letter in hiraganaTable" :key="letter.romaji" class="p-4 bg-white border-r border-amber-200/60 last:border-r-0 flex flex-col items-center justify-center">
                  <p class="text-[32px] font-black text-[#2563EB] mb-2 leading-none">{{ letter.upper }}</p>
                  <p class="text-[40px] font-medium text-[#1E3A8A] leading-none mb-2">{{ letter.char }}</p>
                  <p class="text-sm font-black text-blue-500/80">{{ letter.romaji }}</p>
                </div>
              </div>
            </div>
          </div>

          <div>
            <h4 class="text-xl font-black text-gray-900 mb-4">Tips Menghafal Huruf Dasar Hiragana</h4>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
              <article
                v-for="tip in learningTips"
                :key="tip.id"
                class="rounded-2xl border border-blue-100 bg-[#F8FAFC] p-5 shadow-sm"
              >
                <div class="flex items-start gap-3 mb-2">
                  <div class="text-2xl">{{ tip.icon }}</div>
                  <h5 class="text-base font-black text-gray-800 leading-tight">{{ tip.title }}</h5>
                </div>
                <p class="text-xs font-medium text-gray-500 leading-relaxed">{{ tip.description }}</p>
              </article>
            </div>
          </div>
        </section>
      </template>
    </div>
  </div>
</template>

<script setup>
import { ref } from 'vue';

const emit = defineEmits(['navigate']);

const detailView = ref('materi_list'); // 'materi_list' or 'materi_detail'
const activeTab = ref('materi');

const materials = ref([
  { id: 1, title: 'Dasar Hiragana', description: 'Belajar dasar pengenalan huruf hiragana.', status: 'completed' },
  { id: 2, title: 'Huruf Baris K', description: 'Belajar dasar pengenalan huruf hiragana.', status: 'locked' },
  { id: 3, title: 'Huruf Baris K', description: 'Belajar dasar pengenalan huruf hiragana.', status: 'locked' },
  { id: 4, title: 'Huruf Baris K', description: 'Belajar dasar pengenalan huruf hiragana.', status: 'locked' }
]);

const hiraganaTable = [
  { upper: 'A', char: 'あ', romaji: 'a' },
  { upper: 'I', char: 'い', romaji: 'i' },
  { upper: 'U', char: 'う', romaji: 'u' },
  { upper: 'E', char: 'え', romaji: 'e' },
  { upper: 'O', char: 'お', romaji: 'o' },
];

const learningTips = [
  { id: 1, icon: '📝', title: 'Ulangi dan Tulis', description: 'Tulislah setiap huruf hingga terbiasa dengan bentuknya dan cara pengucapannya.' },
  { id: 2, icon: '📇', title: 'Gunakan Kartu', description: 'Tulislah setiap huruf hingga terbiasa dengan bentuknya dan cara pengucapannya.' },
  { id: 3, icon: '🎮', title: 'Bermain Quiz', description: 'Tulislah setiap huruf hingga terbiasa dengan bentuknya dan cara pengucapannya.' },
];
</script>
