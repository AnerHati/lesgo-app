<template>
<div class="max-w-6xl mx-auto w-full space-y-6">
          <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
            <!-- Hero Banner -->
            <div class="lg:col-span-8 bg-gradient-to-r from-[#0EA5E9] to-[#3B82F6] rounded-[32px] p-8 lg:p-10 flex justify-between items-center text-white relative overflow-hidden animate-fade-in">
              <div class="hero-orb-1"></div>
              <div class="hero-orb-2"></div>
              <div class="z-10 max-w-md">
                <h2 class="text-3xl lg:text-4xl font-black mb-3">Selamat datang, Isyana!<br>Siap mengajar?</h2>
                <p class="text-blue-50 font-medium mb-8 text-sm opacity-90">Temukan siswa di sekitarmu.</p>
                <button type="button" @click="goNav('cari_siswa')" class="group bg-white text-blue-600 hover:bg-blue-50 px-8 py-3 rounded-xl font-bold text-sm inline-flex items-center gap-2 transition-all duration-300 hover:shadow-lg active:scale-95">
                  🔍 Cari Siswa
                  <span class="group-hover:translate-x-1 transition-transform">→</span>
                </button>
              </div>
              <div class="absolute right-6 lg:right-10 bottom-0 w-40 h-40 lg:w-48 lg:h-48 opacity-90 hidden sm:block animate-float">
                <span class="text-[110px]">👨🏻‍🏫</span>
              </div>lu ada 
            </div>

             <!-- Notifikasi Pesanan Masuk -->
            <div class="lg:col-span-4 bg-white rounded-[32px] p-6 border border-gray-100 shadow-sm flex flex-col hover:-translate-y-1 hover:shadow-xl hover:shadow-blue-500/10 transition-all duration-300 animate-fade-in-delay-1">
              <div class="flex justify-between items-center mb-6">
                <h3 class="font-bold text-gray-900 flex items-center gap-2">🔔 Pesanan Masuk</h3>
                <span v-if="props.pesanan.length > 0" class="bg-blue-100 text-blue-700 text-xs font-bold px-2 py-0.5 rounded-lg">{{ props.pesanan.length }} Pesanan</span>
              </div>
              <div class="space-y-5">
                <!-- Jika kosong -->
                <div v-if="props.pesanan.length === 0" class="text-center py-6 text-gray-400 font-medium text-sm border-2 border-dashed border-gray-100 rounded-2xl">
                  Belum ada pesanan masuk.
                </div>
                <!-- Looping Pesanan -->
                <div v-for="n in props.pesanan" :key="n.id" class="flex flex-col gap-3 p-4 bg-blue-50/50 rounded-2xl border border-blue-100/50">
                  <div class="flex gap-3 items-start">
                    <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-[#0EA5E9] shadow-md text-white rounded-xl flex items-center justify-center text-lg shrink-0">{{ n.subject.icon || '🆕' }}</div>
                    <div>
                      <p class="text-[13px] font-black text-gray-900 leading-tight">Siswa: {{ n.student.name }}</p>
                      <p class="text-[11px] text-gray-600 font-medium mt-1">Mempelajari {{ n.subject.name }}</p>
                      <p class="text-[10px] text-blue-600 font-bold mt-1 bg-white px-2 py-0.5 rounded-md inline-block border border-blue-100">{{ n.paket_mengajar }} | {{ n.metode_belajar }}</p>
                    </div>
                  </div>
                  <!-- Action Buttons -->
                  <div class="flex gap-2 w-full mt-2">
                    <button @click="terimaPesanan(n.id)" type="button" class="flex-1 bg-[#2563EB] hover:bg-blue-700 text-white text-xs font-bold py-2.5 rounded-xl shadow-sm transition-colors active:scale-95">Terima</button>
                    <button @click="tolakPesanan(n.id)" type="button" class="flex-1 bg-white hover:bg-red-50 text-red-500 border border-red-200 text-xs font-bold py-2.5 rounded-xl shadow-sm transition-colors active:scale-95">Tolak</button>
                  </div>
                </div>
              </div>
            </div>

          </div>

          <!-- Row 2: Siswa Terdekat + Jadwal Mengajar + Penghasilan -->
          <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
                       <!-- Siswa Saya -->
            <div class="lg:col-span-4 bg-white rounded-[32px] p-6 border border-gray-100 shadow-sm flex flex-col hover:-translate-y-1 hover:shadow-xl hover:shadow-blue-500/10 transition-all duration-300 animate-slide-up">
              <div class="flex justify-between items-center mb-5">
                <h3 class="font-bold text-gray-900 flex items-center gap-2">👨‍🎓 Siswa Saya</h3>
                <a href="#" @click.prevent="$emit('navigate', 'siswa_saya')" class="text-xs text-gray-400 font-bold hover:text-blue-600 transition">Lihat Semua</a>
              </div>
              <div class="space-y-4">
                <div v-if="props.kelasAktif.length === 0" class="text-center py-4 text-gray-400 text-xs">Belum ada siswa aktif.</div>
                
                <!-- Looping dari data kelasAktif asli -->
                <div v-for="k in props.kelasAktif" :key="'siswa-'+k.id" class="flex items-center justify-between gap-3">
                  <div class="flex items-center gap-3 min-w-0">
                    <div class="w-10 h-10 rounded-full bg-gray-100 flex items-center justify-center text-lg shrink-0 overflow-hidden">
                      <img :src="`https://ui-avatars.com/api/?name=${k.student.name.replace(' ','+')}&background=f3f4f6&color=4b5563&size=80`" class="w-full h-full object-cover">
                    </div>
                    <div class="min-w-0">
                      <h4 class="text-[13px] font-bold text-gray-800 leading-none truncate">{{ k.student.name }}</h4>
                      <p class="text-[10px] text-gray-500 mt-1">{{ k.subject.name }} ({{ k.paket_mengajar }})</p>
                    </div>
                  </div>
                  <button type="button" @click="$emit('navigate', 'kelas_saya')" class="shrink-0 px-3 py-1.5 rounded-lg text-[11px] font-bold bg-[#3B82F6] text-white hover:bg-blue-700 transition shadow-sm">
                    Lihat Kelas
                  </button>
                </div>
              </div>
            </div>

            <!-- Jadwal Mengajar -->
            <div class="lg:col-span-4 bg-white rounded-[32px] p-6 border border-gray-100 shadow-sm flex flex-col hover:-translate-y-1 hover:shadow-xl hover:shadow-blue-500/10 transition-all duration-300 animate-slide-up-delay-1">
              <div class="flex justify-between items-center mb-5">
                <h3 class="font-bold text-gray-900 flex items-center gap-2">📅 Jadwal Mengajar</h3>
                <a href="#" @click.prevent="$emit('navigate', 'jadwal')" class="text-xs text-gray-400 font-bold hover:text-blue-600 transition">Lihat Semua</a>
              </div>
              <div class="space-y-4">
                <div v-if="props.jadwal.length === 0" class="text-center py-4 text-gray-400 text-xs">Belum ada jadwal terdekat.</div>
                
                <!-- Looping dari data jadwal asli -->
                <div v-for="j in props.jadwal" :key="'jadwal-'+j.id" class="flex items-center gap-3">
                  <div class="w-10 h-10 rounded-full bg-gray-100 flex items-center justify-center text-lg shrink-0 overflow-hidden">
                    <img :src="`https://ui-avatars.com/api/?name=${j.study_class.student.name.replace(' ','+')}&background=f3f4f6&color=4b5563&size=80`" class="w-full h-full object-cover">
                  </div>
                  <div>
                    <h4 class="text-[13px] font-bold text-[#3B82F6] leading-none">{{ j.study_class.student.name }}</h4>
                    <p class="text-[10px] text-gray-500 font-medium mt-1">{{ j.study_class.subject.name }}</p>
                    <p class="text-[10px] text-gray-400 mt-0.5">{{ formatTanggal(j.start_time) }}</p>
                  </div>
                </div>
              </div>
            </div>

            <!-- Penghasilan -->
            <div class="lg:col-span-4 bg-white rounded-[32px] p-6 border border-gray-100 shadow-sm flex flex-col hover:-translate-y-1 hover:shadow-xl hover:shadow-blue-500/10 transition-all duration-300 animate-slide-up-delay-2">
              <div class="flex justify-between items-center mb-4">
                <h3 class="font-bold text-gray-900 flex items-center gap-2">💰 Penghasilan</h3>
                <a href="#" class="text-xs text-gray-400 font-bold hover:text-blue-600 transition">Lihat Semua</a>
              </div>
                            <div class="mb-3">
                <p class="text-[10px] text-gray-400 font-bold uppercase tracking-wider">Total Pendapatan</p>
                <div class="flex items-end gap-2 mt-1">
                  
                  <span class="text-2xl font-black text-gray-900">{{ formatRupiah(props.statistik.totalPenghasilan) }}</span>
                </div>
              </div>
              <div class="flex items-center gap-2 mb-3">
                
                <div class="bg-blue-100 text-blue-700 text-[10px] font-bold px-2.5 py-1 rounded-lg">{{ props.statistik.totalTransaksi }} Transaksi Selesai</div>
              </div>

              <div class="flex items-center gap-2 mb-3">
                <div class="bg-blue-100 text-blue-700 text-[10px] font-bold px-2.5 py-1 rounded-lg">1,343 sales</div>
              </div>
              <!-- Inline SVG Chart -->
              <div class="flex-1 min-h-[100px] relative">
                <svg viewBox="0 0 280 100" class="w-full h-full" preserveAspectRatio="none">
                  <defs>
                    <linearGradient id="chartGrad" x1="0%" y1="0%" x2="0%" y2="100%">
                      <stop offset="0%" style="stop-color:#3B82F6;stop-opacity:0.15" />
                      <stop offset="100%" style="stop-color:#3B82F6;stop-opacity:0" />
                    </linearGradient>
                  </defs>
                  <path d="M0,70 Q20,65 40,60 T80,50 T120,55 T160,35 T200,45 T240,25 T280,30 L280,100 L0,100 Z" fill="url(#chartGrad)" />
                  <polyline fill="none" stroke="#3B82F6" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" points="0,70 40,60 80,50 120,55 160,35 200,45 240,25 280,30" />
                  <circle cx="240" cy="25" r="4" fill="#3B82F6" stroke="white" stroke-width="2" />
                </svg>
                <div class="flex justify-between text-[9px] text-gray-400 font-bold mt-1 px-1">
                  <span>J</span><span>F</span><span>M</span><span>A</span><span>M</span><span>J</span><span>J</span><span>A</span><span>S</span><span>O</span><span>N</span><span>D</span>
                </div>
              </div>
            </div>
          </div>

          <!-- Row 3: Performa Siswa -->
          <section class="bg-white rounded-[32px] p-6 border border-gray-100 shadow-sm hover:shadow-xl hover:shadow-blue-500/10 transition-all duration-300 animate-fade-in-delay-3">
            <div class="flex justify-between items-center mb-6">
              <h3 class="font-bold text-gray-900 flex items-center gap-2">📊 Performa Siswa</h3>
              <a href="#" class="text-xs text-gray-400 font-bold hover:text-blue-600 transition">Lihat Semua</a>
            </div>
            <div class="space-y-4">
              <div v-for="p in performaSiswa" :key="p.id" class="flex items-center gap-4">
                <div class="w-10 h-10 rounded-full overflow-hidden shrink-0 bg-gray-100">
                  <img :src="`https://ui-avatars.com/api/?name=${p.name.replace(' ','+')}&background=f3f4f6&color=4b5563&size=80`" class="w-full h-full object-cover">
                </div>
                <div class="min-w-0 flex-1">
                  <div class="flex items-center justify-between mb-1">
                    <div>
                      <h4 class="text-[13px] font-bold text-[#3B82F6] leading-none">{{ p.name }}</h4>
                      <p class="text-[10px] text-gray-400 mt-0.5">{{ p.mapel }}</p>
                    </div>
                    <span class="text-[12px] font-bold text-gray-600">{{ p.percent }}%</span>
                  </div>
                  <div class="h-2 rounded-full bg-gray-100 overflow-hidden">
                    <div class="h-full rounded-full bg-gradient-to-r from-[#3B82F6] to-[#0EA5E9] progress-shine transition-all" :style="{ width: `${p.percent}%` }"></div>
                  </div>
                </div>
              </div>
            </div>
          </section>

</div>
</template>

<script setup>
import { ref, computed } from 'vue'

const emit = defineEmits(['navigate'])
function goNav(id) { emit('navigate', id) }
const notifikasi = [
  { id: 1, icon: '📘', title: 'Sesi mengajar hari ini', desc: 'Mengajar Dovina, 15:00-16:00', time: '1 jam lalu' },
  { id: 2, icon: '🆕', title: 'Siswa Baru', desc: 'Aninda mencari tutor matematika, segera konfirmasi!', time: '2 jam lalu' },
]
const siswaDekat = [
  { id: 1, name: 'N.Natasha', distance: '400m', schedule: '08:00-17:00' },
  { id: 2, name: 'Kenzo Aliza', distance: '1,2km', schedule: 'Jumat, 19:00-20:00' },
  { id: 3, name: 'Rina Putri', distance: '1,5km', schedule: 'Minggu, 15:00-17:00' },
]
const jadwalMengajar = [
  { id: 1, siswa: 'Kevin H', mapel: 'Matematika-SMP', waktu: 'Hari ini, 2:00-15.00' },
  { id: 2, siswa: 'Eka Savitry', mapel: 'Matematika-SMA', waktu: 'Harini, 15:00-16:00' },
  { id: 3, siswa: 'Natasha', mapel: 'Matematika-SD', waktu: 'Minggu, 15:00-13:00' },
]
const performaSiswa = computed(() => {
  if (!props.kelasAktif || props.kelasAktif.length === 0) return [];
  
  return props.kelasAktif.map(kelas => {
    const totalTasks = kelas.tasks ? kelas.tasks.length : 0;
    
    // Asumsi status tugas 'completed' jika sudah selesai dikerjakan.
    const completedTasks = kelas.tasks 
        ? kelas.tasks.filter(t => t.status === 'completed' || t.status === 'done').length 
        : 0;
    
    let percent = 0;
    if (totalTasks > 0) {
        percent = Math.round((completedTasks / totalTasks) * 100);
    }
    
    return {
      id: kelas.id,
      name: kelas.student.name,
      mapel: kelas.subject.name,
      percent: percent
    };
  });
});




import { router } from '@inertiajs/vue3'

const props = defineProps({
  pesanan: { type: Array, default: () => [] },
  kelasAktif: { type: Array, default: () => [] },
  jadwal: { type: Array, default: () => [] } ,
  statistik: { type: Object, default: () => ({ totalPenghasilan: 0, totalTransaksi: 0 }) },
})
// format mata uang
function formatRupiah(angka) {
    return new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', maximumFractionDigits: 0 }).format(angka || 0);
}
// Fungsi untuk merapikan tanggal (contoh: "Min, 14 Mei 15.00")
function formatTanggal(isoString) {
    if(!isoString) return '';
    const d = new Date(isoString);
    return d.toLocaleDateString('id-ID', { 
        weekday: 'short', day: 'numeric', month: 'short', hour: '2-digit', minute:'2-digit' 
    });
}


function terimaPesanan(id) {
    if(confirm('Apakah Anda yakin ingin Menerima pesanan ini?')) {
        router.post(`/tutor/booking/${id}/accept`);
    }
}

function tolakPesanan(id) {
    if(confirm('Apakah Anda yakin ingin Menolak pesanan ini?')) {
        router.post(`/tutor/booking/${id}/reject`);
    }
}

</script>

