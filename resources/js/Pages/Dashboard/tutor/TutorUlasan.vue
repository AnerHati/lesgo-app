<template>
          <div class="max-w-6xl mx-auto w-full space-y-6 animate-fade-in">

            <!-- List View -->
            <template v-if="ulasanView === 'list'">
              <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <div class="lg:col-span-2">
                  <h2 class="text-3xl font-black text-gray-900 mb-2">Ulasan</h2>
                  <p class="text-gray-500 font-medium text-sm">Tingkatkan kualitas ajarmu.</p>
                  <p class="text-gray-500 font-medium text-sm">Baca dan kelola ulasan dari siswa untuk meningkatkan kualitas mengajarmu.</p>
                  <button type="button" class="mt-4 bg-[#2563EB] text-white px-5 py-2.5 rounded-xl font-bold text-sm hover:bg-blue-700 transition shadow-sm inline-flex items-center gap-2">📊 Analisis</button>
                </div>
                <!-- Ringkasan -->
                <div class="bg-white rounded-[24px] border border-gray-200 p-6 shadow-sm">
                  <h3 class="font-bold text-gray-900 mb-3">Ringkasan Ulasan</h3>
                  <div class="flex items-center gap-2 mb-4">
                    <span class="text-3xl">⭐</span>
                    <p class="text-3xl font-black text-gray-900">4.5 <span class="text-sm font-bold text-gray-400">dari 5</span></p>
                  </div>
                  <p class="text-sm font-bold text-gray-500 mb-3">34 Ulasan</p>
                  <div class="space-y-1.5">
                    <div v-for="s in [5,4,3,2,1]" :key="'s'+s" class="flex items-center gap-2">
                      <span class="text-[10px] font-bold text-gray-500 w-4">{{ s }}★</span>
                      <div class="flex-1 h-2 rounded-full bg-gray-100 overflow-hidden">
                        <div class="h-full rounded-full bg-amber-400" :style="{ width: s === 5 ? '65%' : s === 4 ? '20%' : s === 3 ? '10%' : s === 2 ? '3%' : '2%' }"></div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <!-- Reviews List -->
              <div class="bg-white rounded-[24px] border border-gray-200 shadow-sm overflow-hidden">
                <div class="flex items-center gap-2 px-6 pt-6 pb-3">
                  <span class="text-lg">💬</span>
                  <h3 class="font-bold text-gray-900">Ulasan</h3>
                </div>
                <div class="divide-y divide-gray-100">
                  <div v-for="r in ulasanItems" :key="r.id" class="px-6 py-5">
                    <div class="flex items-start justify-between gap-4">
                      <div class="flex items-start gap-3">
                        <div class="w-10 h-10 rounded-full bg-blue-50 overflow-hidden border border-gray-100 shrink-0">
                          <img :src="`https://ui-avatars.com/api/?name=${r.name.replace(' ','+')}&background=${r.avatarBg}&color=${r.avatarColor}&size=80`" class="w-full h-full object-cover">
                        </div>
                        <div>
                          <p class="text-sm font-black text-[#2563EB]">{{ r.name }}</p>
                          <p class="text-[10px] text-gray-400 font-medium">{{ r.mapel }} · {{ r.jenjang }}</p>
                        </div>
                      </div>
                      <div class="flex items-center gap-1 shrink-0">
                        <span v-for="i in 5" :key="'r'+r.id+'s'+i" class="text-sm" :class="i <= r.rating ? 'text-amber-400' : 'text-gray-200'">★</span>
                      </div>
                    </div>
                    <p class="text-sm text-gray-600 font-medium mt-3 leading-relaxed">{{ r.text }}</p>
                    <div class="flex justify-end mt-3">
                      <button @click="openBalasUlasan(r)" type="button" class="px-5 py-2 rounded-xl text-xs font-bold border-2 border-[#2563EB] text-[#2563EB] hover:bg-blue-50 transition">Balas</button>
                    </div>
                  </div>
                </div>
              </div>
            </template>

            <!-- Balas View -->
            <template v-else-if="ulasanView === 'balas'">
              <div class="mb-4">
                <button @click="ulasanView = 'list'" type="button" class="bg-white border border-gray-200 text-gray-700 px-4 py-2 rounded-lg font-bold text-sm inline-flex items-center gap-2 hover:bg-gray-50 transition shadow-sm">
                  <span>←</span> Kembali
                </button>
              </div>

              <!-- Student Review -->
              <div class="bg-white rounded-[24px] border border-gray-200 p-6 shadow-sm">
                <div class="flex items-center gap-3 mb-4">
                  <div class="w-12 h-12 rounded-full bg-blue-50 overflow-hidden border border-gray-100">
                    <img :src="`https://ui-avatars.com/api/?name=${selectedUlasan?.name?.replace(' ','+')}&background=${selectedUlasan?.avatarBg}&color=${selectedUlasan?.avatarColor}&size=96`" class="w-full h-full object-cover">
                  </div>
                  <div>
                    <p class="text-lg font-black text-gray-900">{{ selectedUlasan?.name }}</p>
                    <p class="text-[10px] text-gray-400 font-medium">📅 Diberikan: 18 Mei 2026</p>
                  </div>
                </div>
                <div class="bg-[#F0F7FF] rounded-xl p-4 mb-6">
                  <p class="text-sm text-gray-600 leading-relaxed font-medium">{{ selectedUlasan?.text }}</p>
                </div>

                <h3 class="text-lg font-black text-gray-900 mb-3">Balasan Anda</h3>
                <textarea rows="4" placeholder="Contoh: Terima kasih atas ulasannya, Kevin. Senang sekali mengetahui bahwa penjelasan yang saya berikan dapat membantu kamu lebih memahami materi matematika. Tetap semangat belajar dan jangan ragu untuk bertanya jika ada yang belum dipahami." class="w-full px-4 py-3 rounded-xl border border-gray-200 text-sm font-medium text-gray-700 focus:outline-none focus:border-blue-400 transition resize-none leading-relaxed"></textarea>
                <div class="flex justify-end mt-4">
                  <button type="button" class="bg-[#2563EB] text-white px-6 py-3 rounded-xl font-bold text-sm hover:bg-blue-700 transition shadow-sm">Kirim Balasan</button>
                </div>
              </div>
            </template>

          </div>
</template>

<script setup>
import { ref } from 'vue'
const ulasanView = ref('list')
const selectedUlasan = ref(null)
function openBalasUlasan(review) { selectedUlasan.value = review; ulasanView.value = 'balas' }
const ulasanItems = [
  { id: 1, name: 'Kevin H', mapel: 'Matematika', jenjang: 'SMP', rating: 5, avatarBg: 'dbeafe', avatarColor: '2563eb', text: 'Penjelasan Bu Isyana sangat jelas dan mudah dipahami.' },
  { id: 2, name: 'Raisa Andini', mapel: 'Matematika', jenjang: 'SMP', rating: 5, avatarBg: 'fce7f3', avatarColor: 'db2777', text: 'Belajar dengan Bu Isyana benar-benar membantu saya memahami materi yang sebelumnya terasa sulit.' },
  { id: 3, name: 'Raisa Andini', mapel: 'Matematika', jenjang: 'SMP', rating: 4, avatarBg: 'fce7f3', avatarColor: 'db2777', text: 'Awalnya saya kurang suka matematika tapi setelah belajar dengan Bu Isyana jadi lebih enjoy.' },
]
</script>
