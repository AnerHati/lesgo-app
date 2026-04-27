<template>
          <div class="max-w-6xl mx-auto w-full space-y-6 animate-fade-in">

            <!-- === Riwayat View === -->
            <template v-if="keuanganView === 'riwayat'">
              <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <div class="lg:col-span-2">
                  <h2 class="text-3xl font-black text-gray-900 mb-2">Keuangan</h2>
                  <p class="text-gray-500 font-medium text-sm">Kelola penghasilan mengajarmu!</p>
                  <p class="text-gray-500 font-medium text-sm">Pantau saldo, lihat riwayat transaksi, dan tarik penghasilan dari siswa dengan mudah.</p>
                </div>
                <div class="bg-gradient-to-br from-[#2563EB] to-[#1D4ED8] rounded-[24px] p-6 text-white shadow-lg">
                  <div class="flex justify-between items-start mb-4">
                    <p class="text-xs font-bold text-blue-200">Saldo Saat Ini</p>
                    <span class="text-blue-200 text-xs font-bold">#FM1024</span>
                  </div>
                  <p class="text-3xl font-black mb-5">Rp 6.350.000</p>
                  <div class="space-y-2">
                    <div class="flex items-center gap-2">
                      <span class="w-2 h-2 rounded-full bg-emerald-400"></span>
                      <p class="text-xs font-bold text-blue-100">Saldo Tersedia</p>
                      <p class="text-xs font-black text-white ml-auto">Rp 4.350.000</p>
                    </div>
                    <div class="flex items-center gap-2">
                      <span class="w-2 h-2 rounded-full bg-amber-400"></span>
                      <p class="text-xs font-bold text-blue-100">Dalam Proses</p>
                      <p class="text-xs font-black text-white ml-auto">Rp 2.000.000</p>
                    </div>
                  </div>
                </div>
              </div>

              <div class="flex items-center gap-2 flex-wrap">
                <div class="flex items-center rounded-xl bg-white border border-gray-200 p-1">
                  <button v-for="tab in keuanganTabs" :key="tab.id" type="button"
                    class="px-6 py-2.5 rounded-lg text-sm font-bold transition"
                    :class="keuanganFilter === tab.id ? 'bg-[#2563EB] text-white shadow-sm' : 'text-gray-600 hover:text-gray-800'"
                    @click="keuanganFilter = tab.id"
                  >{{ tab.label }}</button>
                </div>
                <button type="button" class="w-11 h-11 shrink-0 rounded-xl border border-gray-200 bg-white text-gray-500 hover:bg-gray-50 flex items-center justify-center shadow-sm">
                  <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path></svg>
                </button>
                <button @click="keuanganView = 'analisis'" type="button" class="ml-auto bg-[#2563EB] text-white px-5 py-2.5 rounded-xl font-bold text-sm hover:bg-blue-700 transition shadow-sm inline-flex items-center gap-2">
                  📊 Analisis
                </button>
              </div>

              <div class="bg-white rounded-[24px] border border-gray-200 shadow-sm overflow-hidden">
                <div class="flex items-center gap-2 px-6 pt-6 pb-3">
                  <span class="text-lg">📋</span>
                  <h3 class="font-bold text-gray-900">Riwayat</h3>
                </div>
                <div class="divide-y divide-gray-100">
                  <div v-for="tx in filteredKeuangan" :key="tx.id" class="flex items-center gap-4 px-6 py-4 hover:bg-gray-50 transition">
                    <div class="w-11 h-11 rounded-xl flex items-center justify-center text-lg shrink-0" :class="tx.type === 'masuk' ? 'bg-emerald-50' : 'bg-red-50'">
                      🏛️
                    </div>
                    <div class="flex-1 min-w-0">
                      <div class="flex items-center gap-2">
                        <p class="text-sm font-black text-gray-900">{{ tx.title }}</p>
                        <span v-if="tx.badge" class="text-[9px] font-bold px-2 py-0.5 rounded-md" :class="tx.badgeClass">{{ tx.badge }}</span>
                      </div>
                      <p class="text-[11px] text-gray-400 font-medium mt-0.5">{{ tx.desc }}</p>
                    </div>
                    <div class="text-right shrink-0">
                      <p class="text-sm font-black" :class="tx.type === 'masuk' ? 'text-emerald-600' : 'text-red-500'">{{ tx.type === 'masuk' ? '+' : '-' }}Rp {{ tx.amount }}</p>
                      <p class="text-[10px] text-gray-400 font-medium mt-0.5">{{ tx.date }}</p>
                    </div>
                  </div>
                </div>
              </div>
            </template>

            <!-- === Analisis View === -->
            <template v-else-if="keuanganView === 'analisis'">
              <div class="mb-4">
                <button @click="keuanganView = 'riwayat'" type="button" class="bg-white border border-gray-200 text-gray-700 px-4 py-2 rounded-lg font-bold text-sm inline-flex items-center gap-2 hover:bg-gray-50 transition shadow-sm">
                  <span>←</span> Kembali
                </button>
              </div>

              <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <div class="lg:col-span-2">
                  <h2 class="text-3xl font-black text-gray-900 mb-2">Analisis Pendapatan</h2>
                  <p class="text-gray-500 font-medium text-sm">Pantau saldo, lihat riwayat transaksi, dan tarik penghasilan dari siswa dengan mudah.</p>
                </div>
                <div class="bg-white rounded-[20px] border border-gray-200 p-5 shadow-sm flex items-center gap-4">
                  <div class="w-10 h-10 rounded-xl bg-emerald-50 flex items-center justify-center text-lg">💰</div>
                  <div>
                    <p class="text-[10px] text-gray-400 font-bold">Saldo Saat Ini</p>
                    <p class="text-xl font-black text-gray-900">Rp 6.350.000</p>
                  </div>
                </div>
              </div>

              <div class="flex justify-end">
                <select class="bg-white border border-gray-200 rounded-xl px-4 py-2 text-sm font-bold text-gray-700 focus:outline-none focus:border-blue-400 shadow-sm cursor-pointer">
                  <option>Tahun 2025</option>
                  <option>Tahun 2024</option>
                  <option>Tahun 2023</option>
                </select>
              </div>

              <!-- Chart Card -->
              <div class="bg-white rounded-[24px] border-2 border-blue-200 p-8 shadow-sm">
                <div class="mb-6">
                  <p class="text-sm font-bold text-gray-500">Tahun 2025</p>
                  <div class="flex items-center gap-3 mt-1">
                    <p class="text-3xl font-black text-[#2563EB]">Rp 45.000.000</p>
                    <span class="bg-emerald-100 text-emerald-700 text-[10px] font-bold px-2.5 py-0.5 rounded-full inline-flex items-center gap-1">🟢 6.4%</span>
                  </div>
                  <p class="text-xs text-gray-400 font-medium mt-1">Dibandingkan periode sebelumnya</p>
                </div>

                <div class="relative w-full" style="height:280px">
                  <svg viewBox="0 0 800 280" class="w-full h-full" preserveAspectRatio="none">
                    <defs>
                      <linearGradient id="areaGrad" x1="0" y1="0" x2="0" y2="1">
                        <stop offset="0%" stop-color="#3B82F6" stop-opacity="0.25"/>
                        <stop offset="100%" stop-color="#3B82F6" stop-opacity="0.02"/>
                      </linearGradient>
                    </defs>
                    <line v-for="i in 5" :key="'gl'+i" x1="0" :y1="i*50" x2="760" :y2="i*50" stroke="#f0f0f0" stroke-width="1"/>
                    <path d="M0,230 C25,215 50,200 67,190 C100,175 133,180 200,160 C267,140 300,150 333,140 C367,130 400,135 467,110 C500,100 533,105 567,65 C600,45 633,60 667,75 C700,85 733,45 767,35" fill="none" stroke="#3B82F6" stroke-width="3" stroke-linecap="round"/>
                    <path d="M0,230 C25,215 50,200 67,190 C100,175 133,180 200,160 C267,140 300,150 333,140 C367,130 400,135 467,110 C500,100 533,105 567,65 C600,45 633,60 667,75 C700,85 733,45 767,35 L767,280 L0,280 Z" fill="url(#areaGrad)"/>
                    <circle cx="567" cy="65" r="7" fill="#3B82F6" stroke="white" stroke-width="3"/>
                  </svg>
                  <!-- Tooltip -->
                  <div class="absolute bg-gray-800 text-white px-4 py-2.5 rounded-xl shadow-lg" style="top:8%;left:62%;transform:translateX(-50%)">
                    <p class="text-sm font-black">Rp 18.000.000</p>
                    <p class="text-[10px] text-gray-300 font-medium">Pendapatan</p>
                    <div class="absolute left-1/2 -bottom-1.5 w-3 h-3 bg-gray-800 rotate-45 transform -translate-x-1/2"></div>
                  </div>
                  <!-- Y labels -->
                  <div class="absolute right-0 top-0 h-full flex flex-col justify-between py-4 text-[10px] font-bold text-gray-400">
                    <span>25jt</span><span>20jt</span><span>15jt</span><span>10jt</span><span>5jt</span>
                  </div>
                </div>
                <!-- X labels -->
                <div class="flex justify-between mt-4 pr-8">
                  <span v-for="m in ['JAN','FEB','MAR','APR','MEI','JUN','JUL','AGU','SEP','OKT','NOV','DES']" :key="m" class="text-[10px] font-bold text-gray-400">{{ m }}</span>
                </div>
              </div>
            </template>

          </div>
</template>

<script setup>
import { computed, ref } from 'vue'
const keuanganView = ref('riwayat')
const keuanganFilter = ref('semua')
const keuanganTabs = [{ id: 'semua', label: 'Semua' }, { id: 'pemasukan', label: 'Pemasukan' }, { id: 'penarikan', label: 'Penarikan' }]
const keuanganItems = [
  { id: 1, title: 'Komisi Pengajaran', desc: '1 Siswa, Kenzo Aliza', type: 'masuk', amount: '550.000', date: 'Sabtu, 08/12/2025', badge: null, badgeClass: '' },
  { id: 2, title: 'Penarikan Dana', desc: 'Penarikan ke BRI, 6343', type: 'keluar', amount: '350.000', date: 'Sabtu, 08/12/2025', badge: 'Berhasil', badgeClass: 'bg-emerald-100 text-emerald-700' },
  { id: 3, title: 'Komisi Pengajaran', desc: '2 Siswa', type: 'masuk', amount: '550.000', date: 'Sabtu, 08/12/2025', badge: null, badgeClass: '' },
  { id: 4, title: 'Komisi Pengajaran', desc: 'Penarikan ke BRI, 6343', type: 'keluar', amount: '700.000', date: 'Sabtu, 08/12/2025', badge: 'Gagal', badgeClass: 'bg-red-100 text-red-700' },
]
const filteredKeuangan = computed(() => {
  if (keuanganFilter.value === 'pemasukan') return keuanganItems.filter(t => t.type === 'masuk')
  if (keuanganFilter.value === 'penarikan') return keuanganItems.filter(t => t.type === 'keluar')
  return keuanganItems
})
</script>
