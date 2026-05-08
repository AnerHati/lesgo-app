<template>
          <div class="max-w-6xl mx-auto w-full space-y-6 animate-fade-in">

            <!-- List View -->
            <template v-if="kelasView === 'list'">
              <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
                <div>
                  <h2 class="text-3xl font-black text-gray-900 mb-2">Kelas Saya</h2>
                  <p class="text-gray-500 font-medium text-sm">Kelola kelas dan siswa kamu.</p>
                  <p class="text-gray-500 font-medium text-sm">Buat dan kelola kelas berdasarkan mata pelajaran.</p>
                </div>
                <button type="button" class="bg-[#2563EB] text-white px-6 py-3 rounded-xl font-bold text-sm inline-flex items-center gap-2 shadow-sm hover:bg-blue-700 transition">➕ Buat Kelas Baru</button>
              </div>
              <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <article v-for="k in kelasSayaItems" :key="k.id" class="bg-white rounded-[24px] border border-gray-200 shadow-sm p-6 hover:shadow-md hover:-translate-y-1 transition-all duration-300">
                  <div class="flex items-start gap-4 mb-4">
                    <div class="w-14 h-14 rounded-2xl flex items-center justify-center text-2xl shrink-0 shadow-inner" :class="k.bgColor">{{ k.icon }}</div>
                    <div class="flex-1 min-w-0">
                      <h3 class="text-lg font-black text-gray-900 leading-tight">{{ k.subject }}</h3>
                      <p class="text-xs font-bold text-blue-500 mt-0.5">{{ k.level }}</p>
                      <div class="flex flex-wrap gap-x-4 gap-y-1 mt-2 text-[11px] text-gray-400 font-semibold">
                        <span>👥 {{ k.siswaCount }} Siswa</span>
                        <span>📅 {{ k.jadwal }}</span>
                      </div>
                    </div>
                  </div>
                  <div class="flex items-center justify-between">
                    <div class="flex -space-x-2">
                      <div v-for="(a, ai) in k.avatars" :key="ai" class="w-8 h-8 rounded-full border-2 border-white overflow-hidden shadow-sm">
                        <img :src="`https://ui-avatars.com/api/?name=${a.replace(' ','+')}&background=${['dbeafe','fce7f3','d1fae5','fef3c7'][ai % 4]}&color=${['2563eb','db2777','059669','d97706'][ai % 4]}&size=64`" class="w-full h-full object-cover">
                      </div>
                      <div v-if="k.siswaCount > k.avatars.length" class="w-8 h-8 rounded-full border-2 border-white bg-gray-100 flex items-center justify-center text-[10px] font-bold text-gray-500 shadow-sm">+{{ k.siswaCount - k.avatars.length }}</div>
                    </div>
                    <button @click="openKelasDetail(k)" type="button" class="px-5 py-2 rounded-xl text-sm font-bold border-2 border-[#2563EB] text-[#2563EB] hover:bg-blue-50 transition">Lihat Kelas</button>
                  </div>
                </article>
              </div>
            </template>

            <!-- Detail View -->
            <template v-else-if="kelasView === 'detail'">
              <div class="mb-4">
                <button @click="kelasView = 'list'" type="button" class="bg-white border border-gray-200 text-gray-700 px-4 py-2 rounded-lg font-bold text-sm inline-flex items-center gap-2 hover:bg-gray-50 transition shadow-sm">
                  <span>←</span> Kembali
                </button>
              </div>

              <!-- Class Header Card -->
              <div class="bg-white rounded-[24px] border border-gray-200 p-8 shadow-sm">
                <div class="flex flex-col md:flex-row gap-6 items-start">
                  <div class="w-20 h-20 rounded-2xl flex items-center justify-center text-4xl shrink-0 shadow-inner" :class="selectedKelas?.bgColor || 'bg-blue-100'">
                    {{ selectedKelas?.icon }}
                  </div>
                  <div class="flex-1">
                    <h2 class="text-3xl font-black text-gray-900 mb-1">{{ selectedKelas?.subject }}</h2>
                    <span class="inline-block bg-blue-100 text-blue-700 text-xs font-bold px-3 py-1 rounded-lg">{{ selectedKelas?.level }}</span>
                    <p class="text-sm text-gray-500 font-medium mt-3 leading-relaxed">Kelas ini fokus pada pemahaman konsep dasar hingga latihan soal untuk meningkatkan kemampuan matematika siswa.</p>
                  </div>
                </div>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mt-8">
                  <div class="flex items-center gap-3">
                    <span class="text-gray-400 text-xl">📅</span>
                    <div>
                      <p class="text-[10px] text-gray-400 font-bold">Jadwal</p>
                      <p class="text-xs font-bold text-gray-700">{{ selectedKelas?.jadwal }}</p>
                      <p class="text-[10px] text-gray-400">16.00 - 18.00</p>
                    </div>
                  </div>
                  <div class="flex items-center gap-3">
                    <span class="text-gray-400 text-xl">✍️</span>
                    <div>
                      <p class="text-[10px] text-gray-400 font-bold">Metode</p>
                      <p class="text-xs font-bold text-gray-700">Online dan Offline</p>
                      <p class="text-[10px] text-gray-400">Datangi ke rumah dan Online</p>
                    </div>
                  </div>
                  <div class="flex items-center gap-3">
                    <span class="text-gray-400 text-xl">👥</span>
                    <div>
                      <p class="text-[10px] text-gray-400 font-bold">Total Siswa</p>
                      <p class="text-xs font-bold text-gray-700">{{ selectedKelas?.siswaCount }} Siswa</p>
                    </div>
                  </div>
                </div>
              </div>

              <!-- Students Grid -->
              <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5 mt-6">
                <div v-for="st in kelasDetailSiswa" :key="st.id" class="bg-white rounded-[20px] border border-gray-200 shadow-sm p-5 hover:shadow-md hover:-translate-y-1 transition-all duration-300 flex flex-col items-center text-center">
                  <div class="w-16 h-16 rounded-full bg-blue-50 overflow-hidden border-2 border-white shadow-md mb-3">
                    <img :src="`https://ui-avatars.com/api/?name=${st.name.replace(' ','+')}&background=eff6ff&color=2563eb&size=128`" class="w-full h-full object-cover">
                  </div>
                  <h4 class="text-sm font-black text-gray-900">{{ st.name }}</h4>
                  <p class="text-[11px] font-bold text-gray-500 mt-0.5">{{ st.mapel }}</p>
                  <div class="flex flex-wrap justify-center gap-x-3 gap-y-1 mt-1.5 text-[10px] text-gray-400 font-semibold">
                    <span>🎓 {{ st.jenjang }}</span>
                    <span>📍 {{ st.lokasi }}</span>
                  </div>
                  <button @click="openKelasSiswaDetail(st)" type="button" class="mt-4 w-full py-2 rounded-xl text-xs font-bold border-2 border-[#2563EB] text-[#2563EB] hover:bg-blue-50 transition">Lihat Detail</button>
                </div>
              </div>
            </template>

            <!-- Siswa Detail View -->
            <template v-else-if="kelasView === 'siswa_detail'">
              <div class="mb-4">
                <button @click="kelasView = 'detail'" type="button" class="bg-white border border-gray-200 text-gray-700 px-4 py-2 rounded-lg font-bold text-sm inline-flex items-center gap-2 hover:bg-gray-50 transition shadow-sm">
                  <span>←</span> Kembali
                </button>
              </div>

              <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Left Column -->
                <div class="lg:col-span-2 space-y-6">
                  <!-- Profile Header -->
                  <div class="bg-white rounded-[24px] border border-gray-200 p-6 shadow-sm">
                    <div class="flex flex-col md:flex-row gap-5 items-start">
                      <div class="w-20 h-20 rounded-full bg-blue-50 overflow-hidden border-4 border-white shadow-md shrink-0">
                        <img :src="`https://ui-avatars.com/api/?name=${selectedKelasSiswa?.name?.replace(' ','+')}&background=eff6ff&color=2563eb&size=160`" class="w-full h-full object-cover">
                      </div>
                      <div class="flex-1">
                        <div class="flex items-center gap-3 mb-1">
                          <h2 class="text-2xl font-black text-gray-900">{{ selectedKelasSiswa?.name }}</h2>
                          <span class="bg-blue-100 text-blue-700 text-[10px] font-bold px-2.5 py-0.5 rounded-lg">Aktif</span>
                        </div>
                        <div class="space-y-1.5 mt-2">
                          <p class="text-sm font-bold text-gray-500 flex items-center gap-2">📚 {{ selectedKelasSiswa?.mapel }} · {{ selectedKelasSiswa?.jenjang }}</p>
                          <p class="text-sm font-bold text-gray-500 flex items-center gap-2">🏠 Metode: Datang ke rumah Tukad Badung, no 12</p>
                          <p class="text-sm font-bold text-gray-500 flex items-center gap-2">📅 Senin & Rabu, 16.00-17.00</p>
                        </div>
                      </div>
                    </div>
                  </div>

                  <!-- Materi Terbaru -->
                  <div class="bg-white rounded-[24px] border border-gray-200 p-6 shadow-sm">
                    <div class="flex justify-between items-center mb-5">
                      <h3 class="font-bold text-gray-900">Materi Terbaru</h3>
                      <a @click.prevent="kelasView = 'materi_detail'" href="#" class="text-xs text-gray-400 font-bold hover:text-blue-600 transition cursor-pointer">Lihat Semua</a>
                    </div>
                    <div class="space-y-4">
                      <div v-for="m in materiTerbaru" :key="m.id" class="flex items-center justify-between gap-4">
                        <div class="flex items-center gap-3">
                          <div class="w-10 h-10 rounded-xl flex items-center justify-center text-lg shrink-0" :class="m.done ? 'bg-emerald-50 text-emerald-600' : 'bg-orange-50 text-orange-500'">
                            {{ m.icon }}
                          </div>
                          <div>
                            <p class="text-sm font-bold text-gray-800">{{ m.title }}</p>
                            <p class="text-[10px] text-gray-400 font-medium">Dipelajari: {{ m.date }}</p>
                          </div>
                        </div>
                        <span class="text-[11px] font-bold px-3 py-1 rounded-lg shrink-0" :class="m.done ? 'bg-emerald-50 text-emerald-600' : 'bg-orange-50 text-orange-600'">{{ m.status }}</span>
                      </div>
                    </div>
                  </div>
                </div>

                <!-- Right Column -->
                <div class="space-y-6">
                  <!-- Progres Belajar -->
                  <div class="bg-white rounded-[24px] border border-gray-200 p-6 shadow-sm">
                    <h3 class="font-bold text-gray-900 mb-4">Progres Belajar</h3>
                    <div class="flex items-center gap-2 mb-4">
                      <span class="text-sm text-gray-500 font-bold">Keseluruhan</span>
                      <span class="text-sm font-black text-gray-900">3/4</span>
                    </div>
                    <div class="h-3 rounded-full bg-gray-100 overflow-hidden mb-6">
                      <div class="h-full rounded-full bg-gradient-to-r from-[#3B82F6] to-[#0EA5E9] progress-shine" style="width:75%"></div>
                    </div>
                    <div class="grid grid-cols-3 gap-3 text-center">
                      <div class="bg-blue-50 rounded-xl p-3">
                        <p class="text-2xl font-black text-[#2563EB]">3</p>
                        <p class="text-[10px] text-gray-500 font-bold mt-1">Soal Selesai</p>
                      </div>
                      <div class="bg-emerald-50 rounded-xl p-3">
                        <p class="text-2xl font-black text-emerald-600">4.8</p>
                        <p class="text-[10px] text-gray-500 font-bold mt-1">Tugas Selesai</p>
                      </div>
                      <div class="bg-amber-50 rounded-xl p-3">
                        <p class="text-2xl font-black text-amber-600">4.8</p>
                        <p class="text-[10px] text-gray-500 font-bold mt-1">Rata-rata Nilai</p>
                      </div>
                    </div>
                  </div>

                  <!-- Catatan Terakhir -->
                  <div class="bg-white rounded-[24px] border border-gray-200 p-6 shadow-sm">
                    <div class="flex justify-between items-center mb-3">
                      <h3 class="font-bold text-gray-900">Catatan Terakhir</h3>
                      <a @click.prevent="kelasView = 'catatan_detail'" href="#" class="text-xs text-gray-400 font-bold hover:text-blue-600 transition cursor-pointer">Lihat Semua</a>
                    </div>
                    <div class="bg-[#F5F7FF] rounded-xl p-4">
                      <p class="text-xs text-gray-600 leading-relaxed">Kenzo sudah menunjukkan perkembangan yang sangat baik dalam memahami materi pecahan, terutama pada operasi penjumlahan dan pengurangan.</p>
                      <p class="text-[10px] text-blue-500 font-bold mt-3">- Isyana Randini</p>
                    </div>
                  </div>

                  <!-- Tugas Terbaru -->
                  <div class="bg-white rounded-[24px] border border-gray-200 p-6 shadow-sm">
                    <div class="flex justify-between items-center mb-4">
                      <h3 class="font-bold text-gray-900">Tugas Terbaru</h3>
                      <a @click.prevent="kelasView = 'tugas_detail'" href="#" class="text-xs text-gray-400 font-bold hover:text-blue-600 transition cursor-pointer">Lihat Semua</a>
                    </div>
                    <div class="space-y-3">
                      <div class="flex items-center justify-between gap-3">
                        <div class="flex items-center gap-3">
                          <div class="w-8 h-8 rounded-lg bg-blue-50 flex items-center justify-center text-sm">📝</div>
                          <div>
                            <p class="text-xs font-bold text-gray-800">Latihan Soal Pecahan</p>
                            <p class="text-[10px] text-gray-400">Dikumpulkan: 13 Mar</p>
                          </div>
                        </div>
                        <span class="text-[10px] font-bold text-emerald-600 bg-emerald-50 px-2 py-0.5 rounded-lg">Selesai</span>
                      </div>
                      <div class="flex items-center justify-between gap-3">
                        <div class="flex items-center gap-3">
                          <div class="w-8 h-8 rounded-lg bg-orange-50 flex items-center justify-center text-sm">📝</div>
                          <div>
                            <p class="text-xs font-bold text-gray-800">Quiz Desimal</p>
                            <p class="text-[10px] text-gray-400">Dikumpulkan: -</p>
                          </div>
                        </div>
                        <span class="text-[10px] font-bold text-orange-600 bg-orange-50 px-2 py-0.5 rounded-lg">Belum dikerjakan</span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </template>

            <!-- Materi Detail View -->
            <template v-else-if="kelasView === 'materi_detail'">
              <div class="mb-4">
                <button @click="kelasView = 'siswa_detail'" type="button" class="bg-white border border-gray-200 text-gray-700 px-4 py-2 rounded-lg font-bold text-sm inline-flex items-center gap-2 hover:bg-gray-50 transition shadow-sm">
                  <span>←</span> Kembali
                </button>
              </div>

              <!-- Student Header -->
              <div class="flex items-center gap-4 mb-6">
                <div class="w-16 h-16 rounded-full bg-blue-50 overflow-hidden border-4 border-white shadow-md shrink-0">
                  <img :src="`https://ui-avatars.com/api/?name=${selectedKelasSiswa?.name?.replace(' ','+')}&background=eff6ff&color=2563eb&size=128`" class="w-full h-full object-cover">
                </div>
                <div>
                  <h2 class="text-2xl font-black text-gray-900">{{ selectedKelasSiswa?.name }}</h2>
                  <p class="text-sm font-bold text-gray-500">Materi</p>
                </div>
              </div>

              <!-- Buat Materi Form -->
              <div class="bg-white rounded-[24px] border border-gray-200 p-6 shadow-sm mb-6">
                <h3 class="text-lg font-black text-gray-900 mb-4">Buat Materi</h3>
                <div class="space-y-4">
                  <div>
                    <label class="text-xs font-bold text-gray-500 mb-1.5 block">Judul Materi</label>
                    <input type="text" placeholder="Contoh: Operasi Hitung" class="w-full md:w-1/2 px-4 py-2.5 rounded-xl border-2 border-blue-200 text-sm font-medium text-gray-700 focus:border-blue-500 focus:outline-none transition">
                  </div>
                  <div class="flex flex-col md:flex-row gap-4">
                    <div class="flex-1">
                      <label class="text-xs font-bold text-gray-500 mb-1.5 block">Deskripsi Materi</label>
                      <input type="text" placeholder="Contoh: Pengertian pecahan penjumlahan." class="w-full px-4 py-2.5 rounded-xl border border-gray-200 text-sm font-medium text-gray-700 focus:border-blue-500 focus:outline-none transition">
                    </div>
                    <div class="w-full md:w-48">
                      <label class="text-xs font-bold text-gray-500 mb-1.5 block">File Tugas</label>
                      <div class="w-full px-4 py-2.5 rounded-xl border border-gray-200 text-sm text-gray-400 font-medium flex items-center justify-between cursor-pointer hover:border-blue-300 transition">
                        <span>Pilih File</span>
                        <span class="text-[10px] text-gray-300">(Maks. 10 MB)</span>
                      </div>
                    </div>
                    <div class="flex items-end">
                      <button type="button" class="bg-[#2563EB] text-white px-6 py-2.5 rounded-xl font-bold text-sm hover:bg-blue-700 transition shadow-sm whitespace-nowrap">Tambah Tugas</button>
                    </div>
                  </div>
                </div>
              </div>

              <!-- Daftar Tugas -->
              <h3 class="text-lg font-black text-gray-900 mb-4">Daftar Tugas</h3>
              <div class="space-y-4">
                <div v-for="d in daftarMateri" :key="d.id" class="rounded-2xl p-5 flex items-start gap-4 shadow-sm border" :class="d.bgClass">
                  <div class="w-14 h-14 rounded-xl flex items-center justify-center text-xl font-black shrink-0 shadow-inner" :class="d.iconBg">
                    {{ d.iconText }}
                  </div>
                  <div class="flex-1 min-w-0">
                    <h4 class="text-base font-black text-gray-900">{{ d.title }}</h4>
                    <div class="flex items-center gap-2 text-[10px] text-gray-400 font-semibold mt-1">
                      <span>📅 Diunggah: {{ d.date }}</span>
                    </div>
                    <p class="text-xs text-gray-500 mt-1 leading-relaxed">{{ d.desc }}</p>
                  </div>
                  <span class="text-xs font-bold px-3 py-1 rounded-lg shrink-0 whitespace-nowrap" :class="d.statusClass">{{ d.status }}</span>
                </div>
              </div>
            </template>

            <!-- Catatan Detail View -->
            <template v-else-if="kelasView === 'catatan_detail'">
              <div class="mb-4">
                <button @click="kelasView = 'siswa_detail'" type="button" class="bg-white border border-gray-200 text-gray-700 px-4 py-2 rounded-lg font-bold text-sm inline-flex items-center gap-2 hover:bg-gray-50 transition shadow-sm">
                  <span>←</span> Kembali
                </button>
              </div>

              <!-- Student Header -->
              <div class="flex items-center gap-4 mb-6">
                <div class="w-16 h-16 rounded-full bg-blue-50 overflow-hidden border-4 border-white shadow-md shrink-0">
                  <img :src="`https://ui-avatars.com/api/?name=${selectedKelasSiswa?.name?.replace(' ','+')}&background=eff6ff&color=2563eb&size=128`" class="w-full h-full object-cover">
                </div>
                <div>
                  <h2 class="text-2xl font-black text-gray-900">{{ selectedKelasSiswa?.name }}</h2>
                  <p class="text-sm font-bold text-gray-500">Catatan</p>
                </div>
              </div>

              <!-- Catatan Timeline -->
              <div class="bg-white rounded-[24px] border border-gray-200 p-6 shadow-sm">
                <div class="flex items-center gap-2 mb-6">
                  <span class="text-lg">✍️</span>
                  <h3 class="font-bold text-gray-900">Catatan</h3>
                </div>

                <div class="relative pl-6 border-l-2 border-blue-100 space-y-8">
                  <div v-for="c in catatanSiswa" :key="c.id" class="relative">
                    <div class="absolute -left-[25px] top-1 w-4 h-4 rounded-full bg-[#2563EB] border-2 border-white shadow"></div>
                    <p class="text-xs font-black text-gray-800 mb-2">{{ c.tanggal }}</p>
                    <div class="bg-[#F0F7FF] rounded-xl p-4 ml-1">
                      <p class="text-sm text-gray-600 leading-relaxed font-medium">{{ c.isi }}</p>
                    </div>
                  </div>
                </div>
              </div>
            </template>

            <!-- Tugas Detail View -->
            <template v-else-if="kelasView === 'tugas_detail'">
              <div class="mb-4">
                <button @click="kelasView = 'siswa_detail'" type="button" class="bg-white border border-gray-200 text-gray-700 px-4 py-2 rounded-lg font-bold text-sm inline-flex items-center gap-2 hover:bg-gray-50 transition shadow-sm">
                  <span>←</span> Kembali
                </button>
              </div>

              <!-- Student Header -->
              <div class="flex items-center gap-4 mb-6">
                <div class="w-16 h-16 rounded-full bg-blue-50 overflow-hidden border-4 border-white shadow-md shrink-0">
                  <img :src="`https://ui-avatars.com/api/?name=${selectedKelasSiswa?.name?.replace(' ','+')}&background=eff6ff&color=2563eb&size=128`" class="w-full h-full object-cover">
                </div>
                <div>
                  <h2 class="text-2xl font-black text-gray-900">{{ selectedKelasSiswa?.name }}</h2>
                  <p class="text-sm font-bold text-gray-500">Tugas</p>
                </div>
              </div>

              <!-- Buat Tugas Form -->
              <div class="bg-white rounded-[24px] border border-gray-200 p-6 shadow-sm mb-6">
                <h3 class="text-lg font-black text-gray-900 mb-4">Buat Tugas</h3>
                <div class="space-y-4">
                  <div>
                    <label class="text-xs font-bold text-gray-500 mb-1.5 block">Judul Tugas</label>
                    <input type="text" placeholder="Contoh: Operasi Hitung" class="w-full md:w-1/2 px-4 py-2.5 rounded-xl border-2 border-blue-200 text-sm font-medium text-gray-700 focus:border-blue-500 focus:outline-none transition">
                  </div>
                  <div class="flex flex-col md:flex-row gap-4">
                    <div class="flex-1">
                      <label class="text-xs font-bold text-gray-500 mb-1.5 block">Deskripsi Tugas</label>
                      <input type="text" placeholder="Contoh: Kerjakan menurut pemahaman kalian." class="w-full px-4 py-2.5 rounded-xl border border-gray-200 text-sm font-medium text-gray-700 focus:border-blue-500 focus:outline-none transition">
                    </div>
                    <div class="w-full md:w-48">
                      <label class="text-xs font-bold text-gray-500 mb-1.5 block">File Materi</label>
                      <div class="w-full px-4 py-2.5 rounded-xl border border-gray-200 text-sm text-gray-400 font-medium flex items-center justify-between cursor-pointer hover:border-blue-300 transition">
                        <span>Pilih File</span>
                        <span class="text-[10px] text-gray-300">(Maks. 10 MB)</span>
                      </div>
                    </div>
                    <div class="flex items-end">
                      <button type="button" class="bg-[#2563EB] text-white px-6 py-2.5 rounded-xl font-bold text-sm hover:bg-blue-700 transition shadow-sm whitespace-nowrap">Tambah Materi</button>
                    </div>
                  </div>
                </div>
              </div>

              <!-- Daftar Tugas -->
              <h3 class="text-lg font-black text-gray-900 mb-4">Daftar Tugas</h3>
              <div class="space-y-4">
                <div v-for="t in daftarTugas" :key="t.id" class="bg-white rounded-2xl border border-gray-200 shadow-sm p-5 flex items-center gap-4 hover:shadow-md transition">
                  <div class="w-12 h-12 rounded-xl flex items-center justify-center text-xl shrink-0" :class="t.iconBg">
                    {{ t.icon }}
                  </div>
                  <div class="flex-1 min-w-0">
                    <h4 class="text-base font-black text-gray-900">{{ t.title }}</h4>
                    <p class="text-[10px] text-gray-400 font-semibold mt-0.5">📅 Batas Waktu: {{ t.deadline }}</p>
                  </div>
                  <span class="text-xs font-bold px-3 py-1 rounded-lg shrink-0" :class="t.statusClass">{{ t.status }}</span>
                </div>
              </div>
                            <!-- Buat Soal Kuis Form (Baru) -->
              <div class="bg-blue-50/40 rounded-[24px] border border-blue-200 p-6 shadow-sm mb-6">
                <h3 class="text-lg font-black text-blue-900 mb-4">📝 Tambah Soal Pilihan Ganda</h3>
                <form @submit.prevent="submitNewQuestion" class="space-y-4">
                  <div>
                    <label class="text-xs font-bold text-gray-500 mb-1.5 block">Pertanyaan</label>
                    <textarea v-model="newQuestionForm.question" rows="2" placeholder="Contoh: Apa nama ibukota Jepang?" class="w-full px-4 py-2.5 rounded-xl border-2 border-blue-200 text-sm font-medium text-gray-700 focus:border-blue-500 focus:outline-none transition"></textarea>
                  </div>
                  
                  <!-- Grid Pilihan A,B,C,D -->
                  <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div v-for="(opt, index) in newQuestionForm.options" :key="index" class="flex items-center gap-3 bg-white p-2 rounded-xl border border-gray-200 shadow-sm transition-all" :class="opt.is_correct ? 'ring-2 ring-emerald-400 border-emerald-400' : ''">
                      <!-- Label A/B/C/D -->
                      <div class="w-8 h-8 rounded-lg flex items-center justify-center font-bold shrink-0" :class="opt.is_correct ? 'bg-emerald-500 text-white' : 'bg-gray-100 text-gray-500'">
                        {{ opt.label }}
                      </div>
                      <!-- Input Teks Opsi -->
                      <input v-model="opt.value" type="text" :placeholder="`Pilihan ${opt.label}`" class="flex-1 border-none focus:ring-0 text-sm font-medium bg-transparent">
                      <!-- Radio Button Benar/Salah -->
                      <div class="pr-2 flex flex-col items-center">
                        <input type="radio" name="correct_answer" :checked="opt.is_correct" @change="setCorrectOption(index)" class="w-4 h-4 text-emerald-500 border-gray-300 focus:ring-emerald-500 cursor-pointer">
                        <span class="text-[8px] font-bold mt-1 text-gray-400" v-if="opt.is_correct">BENAR</span>
                      </div>
                    </div>
                  </div>
                  
                  <div class="flex justify-end pt-2">
                    <button type="submit" :disabled="isSubmittingQuestion" class="bg-[#2563EB] text-white px-8 py-3 rounded-xl font-bold text-sm hover:bg-blue-700 transition shadow-sm disabled:opacity-50">
                      {{ isSubmittingQuestion ? 'Menyimpan...' : '+ Tambahkan Soal' }}
                    </button>
                  </div>
                </form>
              </div>

            </template>

          </div>
</template>

<script setup>
import { ref } from 'vue'
const kelasView = ref('list')
const selectedKelas = ref(null)
const selectedKelasSiswa = ref(null)
const kelasSayaItems = [
  { id: 1, subject: 'Matematika', level: 'SMP', icon: '⚛️', bgColor: 'bg-blue-100', siswaCount: 8, jadwal: 'Senin & Rabu', avatars: ['Kenzo', 'Eka', 'Natasha', 'Aldi'] },
  { id: 2, subject: 'Informatika', level: 'SMP', icon: '💡', bgColor: 'bg-amber-100', siswaCount: 5, jadwal: 'Senin & Rabu', avatars: ['Rina', 'Budi', 'Maya'] },
  { id: 3, subject: 'Fisika', level: 'SMP', icon: '⚛️', bgColor: 'bg-purple-100', siswaCount: 8, jadwal: 'Senin & Rabu', avatars: ['Iqbal', 'Tania', 'Doni', 'Sari'] },
  { id: 4, subject: 'Kimia', level: 'SMP', icon: '🧪', bgColor: 'bg-green-100', siswaCount: 5, jadwal: 'Senin & Rabu', avatars: ['Ayu', 'Reno', 'Dina'] },
]
const kelasDetailSiswa = [
  { id: 1, name: 'Kenzo Aliza', mapel: 'Matematika', jenjang: 'SMP', lokasi: 'Tukad Badung, no 12' },
  { id: 2, name: 'Ariana Grad', mapel: 'Matematika', jenjang: 'SD', lokasi: 'Online' },
  { id: 3, name: 'Justine', mapel: 'Matematika', jenjang: 'SD', lokasi: 'Online' },
  { id: 4, name: 'Niki', mapel: 'Matematika', jenjang: 'SD', lokasi: 'Tukad Badung, no 12' },
]
const materiTerbaru = [
  { id: 1, title: 'Operasi Pecahan (Penjumlahan & Pengurangan)', icon: '🟢', date: '22 Mar 2026', status: 'Selesai', done: true },
  { id: 2, title: 'Operasi Pecahan (Perkalian & Pembagian)', icon: '🟠', date: '22 Mar 2026', status: 'Belum dipelajari', done: false },
]
const daftarMateri = [
  { id: 1, title: 'Operasi Pecahan (Penjumlahan & Pengurangan)', date: '17 Mei, 19.34', desc: 'Pengertian pecahan penjumlahan berpenyebut sama dan pengurangan pecahan.', iconText: '÷', iconBg: 'bg-blue-100 text-blue-700', bgClass: 'bg-gradient-to-r from-blue-50 to-white border-blue-100', status: 'Selesai', statusClass: 'bg-emerald-50 text-emerald-600' },
  { id: 2, title: 'Operasi Pecahan (Perkalian & Pembagian)', date: '17 Mei, 19.34', desc: 'Pengertian pecahan penjumlahan berpenyebut sama dan pengurangan pecahan.', iconText: '1/22', iconBg: 'bg-amber-100 text-amber-700', bgClass: 'bg-gradient-to-r from-amber-50 to-white border-amber-100', status: 'Sedang dipelajari', statusClass: 'bg-amber-50 text-amber-600' },
]
const catatanSiswa = [
  { id: 1, tanggal: 'Sabtu, 18 Mei 2026', isi: 'Kenzo sudah menunjukkan perkembangan yang sangat baik dalam memahami materi pecahan.' },
  { id: 2, tanggal: 'Jumat, 17 Mei 2026', isi: 'Pada pertemuan kali ini, Kenzo sudah mampu menyelesaikan sebagian besar soal operasi pecahan dengan benar.' },
]
const daftarTugas = [
  { id: 1, title: 'Latihan Soal Pecahan', deadline: '17 Mei, 19.34', icon: '📝', iconBg: 'bg-orange-100', status: 'Diperiksa', statusClass: 'bg-emerald-50 text-emerald-600' },
  { id: 2, title: 'Latihan Soal Pecahan', deadline: '17 Mei, 19.34', icon: '📝', iconBg: 'bg-cyan-100', status: 'Belum Dikerjakan', statusClass: 'bg-orange-50 text-orange-600' },
]
function openKelasDetail(kelas) { selectedKelas.value = kelas; kelasView.value = 'detail' }
function openKelasSiswaDetail(siswa) { selectedKelasSiswa.value = siswa; kelasView.value = 'siswa_detail' }


// --- State Form Kuis ---
const newQuestionForm = ref({
  question: '',
  type: 'multiple_choice',
  options: [
    { label: 'A', value: '', is_correct: true }, // Default A yang benar
    { label: 'B', value: '', is_correct: false },
    { label: 'C', value: '', is_correct: false },
    { label: 'D', value: '', is_correct: false }
  ]
})
const isSubmittingQuestion = ref(false)

// --- Fungsi Submit Soal ---
async function submitNewQuestion() {
  // CATATAN: Karena data kelas tutor di halaman ini masih dummy, 
  // kita tembak/simpan ke ID Tugas 1 sebagai percobaan.
  const taskId = 1; 
  
  if (!newQuestionForm.value.question) return alert('Pertanyaan tidak boleh kosong!');
  
  isSubmittingQuestion.value = true;
  try {
    await window.axios.post(`/api/tasks/${taskId}/questions`, newQuestionForm.value);
    alert('Berhasil! Soal baru berhasil ditambahkan ke Kuis.');
    
    // Kosongkan form kembali setelah sukses
    newQuestionForm.value.question = '';
    newQuestionForm.value.options.forEach((opt, idx) => {
      opt.value = '';
      opt.is_correct = idx === 0; 
    });
  } catch (e) {
    console.error("Gagal tambah soal", e);
    alert('Gagal menyimpan soal kuis.');
  } finally {
    isSubmittingQuestion.value = false;
  }
}

// --- Fungsi Memilih Jawaban Benar ---
function setCorrectOption(index) {
  newQuestionForm.value.options.forEach((opt, idx) => {
    opt.is_correct = (idx === index);
  });
}

  </script>
