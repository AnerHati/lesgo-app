<template>
          <div class="max-w-6xl mx-auto w-full space-y-6 animate-fade-in">

            <!-- === View: Semua === -->
            <template v-if="cariSiswaView === 'semua'">
              <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
                <div>
                  <h2 class="text-3xl font-black text-gray-900 mb-2">Cari Siswa</h2>
                  <p class="text-gray-500 font-medium text-sm">Cari siswa terdekat dan mulai mengajar.</p>
                  <p class="text-gray-500 font-medium text-sm">Lihat profil siswa dan mulai les mengajarnya.</p>
                </div>
                <button @click="cariSiswaView = 'terdekat'" type="button" class="bg-[#2563EB] text-white px-6 py-3 rounded-xl font-bold text-sm inline-flex items-center gap-2 shadow-sm hover:bg-blue-700 transition">
                  📍 Cari Siswa Terdekat
                </button>
              </div>

              <div class="flex items-center gap-2">
                <div class="flex items-center rounded-xl bg-white border border-gray-200 p-1 overflow-x-auto">
                  <button v-for="cat in cariSiswaCategories" :key="cat" type="button"
                    class="px-5 py-2.5 rounded-lg text-sm font-bold whitespace-nowrap transition"
                    :class="cariSiswaFilter === cat ? 'bg-[#2563EB] text-white shadow-sm' : 'text-gray-600 hover:text-gray-800'"
                    @click="cariSiswaFilter = cat"
                  >{{ cat }}</button>
                </div>
                <button type="button" class="w-11 h-11 shrink-0 rounded-xl border border-gray-200 bg-white text-gray-500 hover:bg-gray-50 flex items-center justify-center shadow-sm">
                  <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path></svg>
                </button>
              </div>

              <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <article v-for="siswa in filteredCariSiswa" :key="siswa.id" class="bg-white rounded-[24px] border border-gray-200 shadow-sm p-6 flex flex-col hover:shadow-md hover:-translate-y-1 transition-all duration-300">
                  <div class="flex items-start gap-5 mb-4">
                    <div class="w-16 h-16 rounded-full bg-blue-50 shrink-0 overflow-hidden border border-gray-100 shadow-inner">
                      <img :src="`https://ui-avatars.com/api/?name=${siswa.name.replace(' ','+')}&background=eff6ff&color=2563eb&size=128`" :alt="siswa.name" class="w-full h-full object-cover">
                    </div>
                    <div>
                      <h3 class="text-lg font-black text-[#2563EB] leading-tight">{{ siswa.name }}</h3>
                      <p class="text-xs font-bold text-gray-500 mt-0.5">{{ siswa.mapel }}</p>
                      <div class="flex flex-wrap items-center gap-3 mt-1.5 text-[11px] text-gray-400 font-semibold">
                        <span class="flex items-center gap-1">🎓 {{ siswa.jenjang }}</span>
                        <span class="flex items-center gap-1">📍 {{ siswa.lokasi }}</span>
                      </div>
                    </div>
                  </div>
                  <p class="text-xs text-gray-500 leading-relaxed line-clamp-2 mb-6">{{ siswa.deskripsi }}</p>
                  <div class="mt-auto">
                    <button @click="openSiswaProfil(siswa)" type="button" class="w-full py-2.5 rounded-xl text-sm font-bold bg-[#2563EB] text-white hover:bg-blue-700 transition shadow-sm">Ambil Siswa</button>
                  </div>
                </article>
              </div>

              <div class="flex justify-center items-center gap-2 mt-4 pb-4">
                <button class="w-9 h-9 rounded-lg flex items-center justify-center bg-[#2563EB] text-white font-bold shadow-sm">1</button>
                <button class="w-9 h-9 rounded-lg flex items-center justify-center bg-white border border-gray-200 text-gray-600 hover:bg-gray-50 font-medium">2</button>
                <button class="w-9 h-9 rounded-lg flex items-center justify-center bg-white border border-gray-200 text-gray-600 hover:bg-gray-50 font-medium">3</button>
                <button class="w-9 h-9 rounded-lg flex items-center justify-center bg-white border border-gray-200 text-gray-500 hover:bg-gray-50">›</button>
              </div>
            </template>

            <!-- === View: Terdekat (Map) === -->
            <template v-else-if="cariSiswaView === 'terdekat'">
              <div class="mb-4">
                <button @click="cariSiswaView = 'semua'" type="button" class="bg-white border border-gray-200 text-gray-700 px-4 py-2 rounded-lg font-bold text-sm inline-flex items-center gap-2 hover:bg-gray-50 transition shadow-sm">
                  <span>←</span> Kembali
                </button>
              </div>

              <h2 class="text-3xl font-black text-gray-900 mb-1">Siswa Terdekat di Sekitar Kamu.</h2>
              <p class="text-gray-500 font-medium mb-4">Ditemukan {{ siswaTerdekatList.length }} siswa terdekat dalam 2 km</p>

              <div class="bg-white rounded-[24px] border border-gray-200 shadow-sm overflow-hidden">
                <!-- Map -->
                <div class="relative w-full h-[380px] bg-gray-100 overflow-hidden">
                  <iframe class="absolute inset-0 w-full h-full" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://www.openstreetmap.org/export/embed.html?bbox=115.18%2C-8.72%2C115.28%2C-8.62&amp;layer=mapnik&amp;marker=-8.670%2C115.230"></iframe>
                  <div class="absolute inset-0 pointer-events-none">
                    <!-- Center pin -->
                    <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 flex items-center justify-center">
                      <div class="absolute w-[150px] h-[150px] rounded-full border-2 border-blue-300 bg-blue-100/20"></div>
                      <div class="absolute w-[250px] h-[250px] rounded-full border-2 border-blue-200 bg-blue-50/10"></div>
                      <svg class="w-12 h-12 text-red-600 drop-shadow-md transform -translate-y-4" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/>
                      </svg>
                      <span class="absolute mt-8 bg-white px-2 py-0.5 rounded-full text-[10px] font-bold text-gray-600 shadow">15 Mitutp</span>
                    </div>
                    <!-- Floating student tags -->
                    <div class="absolute top-[18%] left-[25%] bg-white rounded-full p-1 pr-3 flex items-center gap-2 shadow-lg border border-gray-100">
                      <img src="https://ui-avatars.com/api/?name=Iqbal&background=eff6ff&color=2563eb" class="w-8 h-8 rounded-full">
                      <p class="text-xs font-black text-gray-900">Iqbal</p>
                    </div>
                    <div class="absolute top-[25%] right-[15%] bg-white rounded-full p-1 pr-3 flex items-center gap-2 shadow-lg border border-gray-100">
                      <img src="https://ui-avatars.com/api/?name=Isyana&background=eff6ff&color=2563eb" class="w-8 h-8 rounded-full">
                      <p class="text-xs font-black text-gray-900">Isyana</p>
                    </div>
                    <div class="absolute bottom-[30%] left-[30%] bg-white rounded-full p-1 pr-3 flex items-center gap-2 shadow-lg border border-gray-100">
                      <img src="https://ui-avatars.com/api/?name=Aldi&background=eff6ff&color=2563eb" class="w-8 h-8 rounded-full">
                      <p class="text-xs font-black text-gray-900">Aldi</p>
                    </div>
                    <div class="absolute bottom-[20%] right-[20%] bg-white rounded-full p-1 pr-3 flex items-center gap-2 shadow-lg border border-gray-100">
                      <img src="https://ui-avatars.com/api/?name=Maya&background=eff6ff&color=2563eb" class="w-8 h-8 rounded-full">
                      <p class="text-xs font-black text-gray-900">Maya</p>
                    </div>
                  </div>
                </div>

                <!-- Student List Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 bg-white">
                  <div v-for="(s, i) in siswaTerdekatList" :key="s.id"
                    class="flex items-center justify-between p-4 border-b border-gray-200 hover:bg-gray-50 cursor-pointer transition"
                    :class="{ 'md:border-r': i % 2 === 0 }"
                    @click="openSiswaProfil(s)"
                  >
                    <div class="flex items-center gap-3">
                      <img :src="`https://ui-avatars.com/api/?name=${s.name.replace(' ','+')}&background=eff6ff&color=2563eb`" class="w-12 h-12 rounded-full">
                      <div>
                        <h4 class="text-sm font-black text-gray-900">{{ s.name }}</h4>
                        <div class="flex items-center gap-2 text-[10px] text-gray-500 font-semibold mt-0.5">
                          <span>🎓 {{ s.jenjang }}</span>
                        </div>
                        <p class="text-[10px] text-gray-400 mt-0.5">📍 {{ s.alamat }}</p>
                      </div>
                    </div>
                    <div class="text-xs font-bold text-gray-500 flex items-center gap-1 shrink-0">
                      <span class="text-gray-400">◎</span> {{ s.jarak }}
                    </div>
                  </div>
                </div>
              </div>
            </template>

            <!-- === View: Profil Siswa === -->
            <template v-else-if="cariSiswaView === 'profil'">
              <div class="mb-4">
                <button @click="cariSiswaView = previousCariView" type="button" class="bg-white border border-gray-200 text-gray-700 px-4 py-2 rounded-lg font-bold text-sm inline-flex items-center gap-2 hover:bg-gray-50 transition shadow-sm">
                  <span>←</span> Kembali
                </button>
              </div>

              <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Left: Profile Details -->
                <div class="lg:col-span-2 bg-white rounded-[24px] border border-gray-200 p-8 shadow-sm">
                  <div class="flex flex-col md:flex-row gap-6 items-start">
                    <div class="w-28 h-28 rounded-full overflow-hidden bg-blue-50 shrink-0 border-4 border-white shadow-md">
                      <img :src="`https://ui-avatars.com/api/?name=${selectedSiswa?.name?.replace(' ','+')}&background=eff6ff&color=2563eb&size=256`" class="w-full h-full object-cover">
                    </div>
                    <div class="pt-1">
                      <h2 class="text-3xl font-black text-gray-900 mb-2">{{ selectedSiswa?.name }}</h2>
                      <div class="space-y-1.5">
                        <p class="flex items-center gap-2 text-sm font-bold text-gray-500"><span class="text-lg">📚</span> {{ selectedSiswa?.mapel || 'Matematika' }}</p>
                        <p class="flex items-center gap-2 text-sm font-bold text-gray-500"><span class="text-lg">📍</span> {{ selectedSiswa?.lokasi || selectedSiswa?.alamat || 'Denpasar Selatan' }}</p>
                      </div>
                    </div>
                  </div>

                  <!-- Motivasi Belajar -->
                  <div class="mt-6 bg-[#F5F7FF] rounded-2xl p-5">
                    <p class="text-sm font-black text-gray-800 italic mb-1">Motivasi Belajar</p>
                    <p class="text-sm text-gray-600 leading-relaxed font-medium">Saya ingin lebih memahami pelajaran matematika dan meningkatkan nilai saya di sekolah saya.</p>
                  </div>

                  <!-- Accepted Banner -->
                  <div v-if="siswaAccepted" class="mt-4 flex items-center gap-2 px-4 py-3 bg-emerald-50 border border-emerald-200 rounded-xl">
                    <span class="text-emerald-500 text-lg">✅</span>
                    <p class="text-sm font-bold text-emerald-700">Anda sudah mengambil siswa ini</p>
                  </div>

                  <!-- Details -->
                  <div class="mt-8 space-y-6">
                    <div>
                      <h4 class="flex items-center gap-2 text-base font-bold text-gray-900 mb-2">
                        <span class="text-emerald-500 text-xl">☑</span> Jenjang
                      </h4>
                      <p class="ml-7 flex items-center gap-2 text-sm font-bold text-gray-500"><span class="text-gray-400">🎓</span> {{ selectedSiswa?.jenjang || 'SD' }}-SMA</p>
                    </div>
                    <div>
                      <h4 class="flex items-center gap-2 text-base font-bold text-gray-900 mb-2">
                        <span class="text-emerald-500 text-xl">☑</span> Mata Pelajaran
                      </h4>
                      <p class="ml-7 flex items-center gap-2 text-sm font-bold text-gray-500"><span class="text-gray-400">📚</span> {{ selectedSiswa?.mapel || 'Matematika' }}</p>
                    </div>
                    <div>
                      <h4 class="flex items-center gap-2 text-base font-bold text-gray-900 mb-2">
                        <span class="text-emerald-500 text-xl">☑</span> Metode Pelajaran
                      </h4>
                      <p class="ml-7 flex items-center gap-2 text-sm font-bold text-gray-500"><span class="text-gray-400">🏠</span> Datangi rumah siswa sekitar Denpasar Selatan</p>
                    </div>
                  </div>

                  <!-- Pricing -->
                  <div class="mt-8 flex items-end justify-end">
                    <div class="text-right">
                      <p class="text-sm font-bold text-gray-500">4x Pertemuan</p>
                      <p class="text-3xl font-black text-gray-900">Rp400.000</p>
                    </div>
                  </div>
                </div>

                <!-- Right: Map + CTA -->
                <div class="space-y-6">
                  <!-- Map Card -->
                  <div class="bg-white rounded-[24px] border border-gray-200 p-4 shadow-sm">
                    <div class="relative w-full h-48 rounded-xl overflow-hidden bg-gray-100 mb-4 border border-gray-100">
                      <iframe class="absolute inset-0 w-full h-full" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://www.openstreetmap.org/export/embed.html?bbox=115.18%2C-8.72%2C115.28%2C-8.62&amp;layer=mapnik&amp;marker=-8.670%2C115.230"></iframe>
                      <div class="absolute inset-0 pointer-events-none flex items-center justify-center">
                        <svg class="w-10 h-10 text-red-600 drop-shadow-md transform -translate-y-2" viewBox="0 0 24 24" fill="currentColor">
                          <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/>
                        </svg>
                      </div>
                      <button @click="cariSiswaView = 'lokasi'" type="button" class="absolute bottom-3 right-3 bg-[#2563EB] text-white px-4 py-2 rounded-xl text-xs font-bold shadow-md hover:bg-blue-700 transition flex items-center gap-1">
                        📍 Lihat Lokasi
                      </button>
                    </div>
                    <p class="text-sm font-bold text-gray-700 flex items-center gap-2 px-2">
                      <span class="text-gray-400 text-lg">⏳</span> Sekitar 2 km dari rumah Anda
                    </p>
                  </div>

                  <!-- CTA Card: Before Accept -->
                  <div v-if="!siswaAccepted" class="bg-white rounded-[24px] border border-gray-200 p-6 shadow-sm">
                    <div class="flex items-start gap-3 mb-5">
                      <span class="text-3xl">👋</span>
                      <div>
                        <p class="text-sm font-black text-gray-900">Siap jadi tutor {{ selectedSiswa?.name }}?</p>
                        <p class="text-sm font-bold text-gray-900">Yuk ambil siswa sekarang!</p>
                      </div>
                    </div>
                    <div class="flex gap-3">
                      <button type="button" class="flex-1 py-3 rounded-xl text-sm font-bold border-2 border-red-500 text-red-500 hover:bg-red-50 transition text-center">Tolak Siswa</button>
                      <button @click="siswaAccepted = true" type="button" class="flex-1 py-3 rounded-xl text-sm font-bold bg-[#2563EB] text-white hover:bg-blue-700 transition shadow-sm text-center">Ambil Siswa</button>
                    </div>
                  </div>

                  <!-- CTA Card: After Accept -->
                  <div v-else class="bg-white rounded-[24px] border border-gray-200 p-6 shadow-sm">
                    <div class="flex items-start gap-3 mb-5">
                      <span class="text-3xl">📅</span>
                      <div>
                        <p class="text-lg font-black text-gray-900">Atur jadwal</p>
                      </div>
                    </div>
                    <button type="button" class="w-full py-3 rounded-xl text-sm font-bold bg-[#2563EB] text-white hover:bg-blue-700 transition shadow-sm text-center">Chat Siswa</button>
                  </div>
                </div>
              </div>
            </template>

            <!-- === View: Lokasi Siswa === -->
            <template v-else-if="cariSiswaView === 'lokasi'">
              <div class="mb-4">
                <button @click="cariSiswaView = 'profil'" type="button" class="bg-white border border-gray-200 text-gray-700 px-4 py-2 rounded-lg font-bold text-sm inline-flex items-center gap-2 hover:bg-gray-50 transition shadow-sm">
                  <span>←</span> Kembali
                </button>
              </div>
              <h2 class="text-3xl font-black mb-6 text-gray-900">Lokasi Siswa</h2>

              <!-- Map -->
              <div class="relative w-full h-[400px] rounded-2xl overflow-hidden border border-gray-200 shadow-sm bg-gray-100">
                <iframe class="absolute inset-0 w-full h-full" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://www.openstreetmap.org/export/embed.html?bbox=115.18%2C-8.72%2C115.28%2C-8.62&amp;layer=mapnik&amp;marker=-8.670%2C115.230"></iframe>
                <div class="absolute inset-0 flex items-center justify-center pointer-events-none">
                  <div class="w-64 h-64 rounded-full border-[6px] border-white shadow-[0_0_0_9999px_rgba(255,255,255,0.4)] flex items-center justify-center relative overflow-hidden">
                    <svg class="w-20 h-20 text-red-600 drop-shadow-xl absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-full" viewBox="0 0 24 24" fill="currentColor">
                      <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/>
                    </svg>
                  </div>
                </div>
                <div class="absolute bottom-6 right-6 flex flex-col gap-3">
                  <button type="button" class="bg-[#2563EB] text-white px-5 py-2.5 rounded-xl font-bold text-sm shadow-lg flex items-center gap-2 hover:bg-blue-700 transition">📍 Buka di Google Maps</button>
                  <button type="button" class="bg-white text-blue-600 px-5 py-2.5 rounded-xl font-bold text-sm shadow-lg flex items-center gap-2 hover:bg-gray-50 transition">🔺 Rute ke Lokasi</button>
                </div>
              </div>

              <!-- Details below map -->
              <div class="bg-white rounded-b-3xl border-x border-b border-gray-200 shadow-sm p-8 relative -mt-4 z-10 mx-2">
                <!-- Floating Student Card -->
                <div class="md:absolute md:-top-12 md:right-8 bg-white rounded-2xl border border-gray-100 shadow-[0_8px_30px_rgb(0,0,0,0.08)] p-5 flex gap-5 md:w-80 w-full mb-6 md:mb-0">
                  <div class="w-16 h-16 rounded-full bg-blue-50 overflow-hidden shrink-0 border border-blue-100">
                    <img :src="`https://ui-avatars.com/api/?name=${selectedSiswa?.name?.replace(' ','+')}&background=eff6ff&color=2563eb`" class="w-full h-full object-cover">
                  </div>
                  <div>
                    <h4 class="text-xl font-black text-[#2563EB] leading-tight">{{ selectedSiswa?.name }}</h4>
                    <p class="text-xs font-bold text-gray-500 mt-1">{{ selectedSiswa?.mapel || 'Matematika' }}</p>
                    <p class="text-[10px] text-gray-400 mt-1 font-semibold">🎓 Siswa {{ selectedSiswa?.jenjang || 'SMP' }}</p>
                    <p class="text-[10px] text-gray-400 mt-0.5 font-semibold">📍 {{ selectedSiswa?.lokasi || selectedSiswa?.alamat || 'Denpasar Selatan' }}</p>
                  </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                  <div class="space-y-6">
                    <div class="space-y-3">
                      <div class="flex items-center gap-3 text-sm font-bold text-gray-700">
                        <span class="text-gray-400 text-lg w-5 text-center">📍</span> Denpasar Selatan
                      </div>
                      <div class="flex items-center gap-3 text-sm font-bold text-gray-700">
                        <span class="text-gray-400 text-lg w-5 text-center">◎</span> Sekitar 2km dari rumah kamu
                      </div>
                    </div>
                    <div>
                      <h3 class="font-black text-gray-900 mb-4 text-lg">Pilih Metode Belajar</h3>
                      <div class="space-y-4">
                        <div class="flex items-start gap-4">
                          <span class="text-gray-400 text-xl w-5 text-center mt-0.5">🏠</span>
                          <div>
                            <p class="text-sm font-bold text-gray-800">Datangi ke rumah kamu</p>
                            <p class="text-xs font-bold text-[#2563EB] mt-1">Area: Denpasar Selatan</p>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="flex flex-col justify-end items-end gap-3 md:pt-20">
                    <div class="flex flex-wrap gap-3 justify-end w-full">
                      <button type="button" class="bg-[#2563EB] text-white px-6 py-3 rounded-xl font-bold text-sm shadow-sm flex items-center gap-2 hover:bg-blue-700 transition">📞 Hubungi Siswa</button>
                      <button type="button" class="bg-[#2563EB] text-white px-6 py-3 rounded-xl font-bold text-sm shadow-sm flex items-center gap-2 hover:bg-blue-700 transition">✅ Ambil Siswa</button>
                    </div>
                  </div>
                </div>
              </div>
            </template>

          </div>
</template>

<script setup>
import { computed, ref } from 'vue'
const cariSiswaFilter = ref('Semua')
const cariSiswaView = ref('semua')
const previousCariView = ref('semua')
const selectedSiswa = ref(null)
const siswaAccepted = ref(false)
const cariSiswaCategories = ['Semua', 'Fisika', 'Matematika', 'Bahasa Inggris', 'Informatika']
const cariSiswaItems = [
  { id: 1, name: 'Kenzo Aliza', mapel: 'Matematika', jenjang: 'SD', lokasi: 'Tobat/Bedung, no 01', deskripsi: 'Halo! Saya Kenzo Aliza, seorang siswa SMP yang senang belajar informatika dan matematika. Mari belajar bersama!' },
  { id: 2, name: 'Eka Savitry', mapel: 'Informatika', jenjang: 'SMP', lokasi: 'Grame', deskripsi: 'Halo! Saya Eka Savitry, seorang siswa SMP yang senang belajar informatika dan matematika. Mari belajar bersama!' },
  { id: 3, name: 'Natasha', mapel: 'Fisika', jenjang: 'SMA', lokasi: 'Online', deskripsi: 'Halo! Saya Kenzo Aliza, seorang siswa SMP yang senang belajar informatika dan matematika. Mari belajar bersama!' },
  { id: 4, name: 'Ananta Aldora', mapel: 'Bahasa Inggris', jenjang: 'SMA', lokasi: 'Tobat Bedung, no 01', deskripsi: 'Halo! Saya Kenzo Aliza, seorang siswa SMP yang senang belajar informatika dan matematika. Mari belajar bersama!' },
  { id: 5, name: 'Kenzo Aliza', mapel: 'Matematika', jenjang: 'SMP', lokasi: 'Tobat/Bedung, no 01', deskripsi: 'Halo! Saya Kenzo Aliza, seorang siswa SMP yang senang belajar informatika dan matematika. Mari belajar bersama!' },
  { id: 6, name: 'Eka Savitry', mapel: 'Informatika', jenjang: 'SMP', lokasi: 'Online', deskripsi: 'Halo! Saya Eka Savitry, seorang siswa SMP yang senang belajar informatika dan matematika. Mari belajar bersama!' },
  { id: 7, name: 'Natasha', mapel: 'Fisika', jenjang: 'SMA', lokasi: 'Online', deskripsi: 'Halo! Saya Kenzo Aliza, seorang siswa SMP yang senang belajar informatika dan matematika. Mari belajar bersama!' },
  { id: 8, name: 'Ananta Aldora', mapel: 'Bahasa Inggris', jenjang: 'SMA', lokasi: 'Tobat Bedung, no 01', deskripsi: 'Halo! Saya Kenzo Aliza, seorang siswa SMP yang senang belajar informatika dan matematika. Mari belajar bersama!' },
]
const filteredCariSiswa = computed(() => {
  if (cariSiswaFilter.value === 'Semua') return cariSiswaItems
  return cariSiswaItems.filter(s => s.mapel === cariSiswaFilter.value)
})
const siswaTerdekatList = [
  { id: 1, name: 'Kenzo Aliza', jenjang: 'SD', alamat: 'Tukad Badung, no 12', jarak: '300m' },
  { id: 2, name: 'Isyana Randini', jenjang: 'SD', alamat: 'Tukad Badung, no 12', jarak: '1.3km' },
  { id: 3, name: 'Iqbal Mustofa', jenjang: 'SD', alamat: 'Tukad Badung, no 0', jarak: '350m' },
  { id: 4, name: 'Iqbal Mustofa', jenjang: 'SD', alamat: 'Tukad Badung, no 0', jarak: '1.2km' },
  { id: 5, name: 'Tania Riana', jenjang: 'SD', alamat: 'Tukad Badung, no 12', jarak: '400m' },
  { id: 6, name: 'Tania Riana', jenjang: 'SD', alamat: 'Tukad Badung, no 12', jarak: '1.5km' },
]
function openSiswaProfil(siswa) { previousCariView.value = cariSiswaView.value; selectedSiswa.value = siswa; siswaAccepted.value = false; cariSiswaView.value = 'profil' }
</script>
