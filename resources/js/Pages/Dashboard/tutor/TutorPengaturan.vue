<template>
          <div class="max-w-6xl mx-auto w-full space-y-6 animate-fade-in">

            <!-- Header -->
            <div>
              <h2 class="text-3xl font-black text-gray-900 mb-2">{{ pengaturanView === 'main' ? 'Pengaturan' : pengaturanView === 'profil' ? 'Pengaturan Profil' : pengaturanView === 'password' ? 'Ganti Kata Sandi' : 'Atur Notifikasi' }}</h2>
              <p class="text-gray-500 font-medium text-sm">{{ pengaturanView === 'main' ? 'Kelola akun dan pengaturanmu.' : pengaturanView === 'profil' ? 'Ubah dan kelola informasi akunmu untuk membuat profilmu lebih akurat.' : pengaturanView === 'password' ? 'Perbarui kata sandi akunmu secara berkala untuk keamanan.' : 'Kelola preferensi notifikasimu.' }}</p>
              <p v-if="pengaturanView === 'main'" class="text-gray-500 font-medium text-sm">Sesuaikan profil dan preferensi sesuai kebutuhanmu.</p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-4 gap-6">
              <!-- Sidebar Profile Card -->
              <div class="lg:col-span-1">
                <div class="bg-white rounded-[24px] border border-gray-200 p-6 shadow-sm text-center">
                  <p class="text-sm font-bold text-gray-700 mb-4">Profil Pengguna</p>
                  <div class="w-20 h-20 mx-auto rounded-full bg-blue-50 overflow-hidden border-4 border-white shadow-md mb-3">
                    <img src="https://ui-avatars.com/api/?name=Isyana+Randini&background=eff6ff&color=2563eb&size=160" class="w-full h-full object-cover">
                  </div>
                  <p class="text-sm font-black text-gray-900">Isyana Randini</p>
                  <p class="text-[10px] text-gray-400 font-medium">Tutor</p>
                  <button v-if="pengaturanView !== 'main'" @click="pengaturanView = 'main'" type="button" class="mt-4 text-xs font-bold text-red-500 hover:text-red-600 transition flex items-center gap-1 mx-auto">🗑️ Hapus Akun</button>
                  <button v-else type="button" class="mt-4 text-xs font-bold text-red-500 hover:text-red-600 transition flex items-center gap-1 mx-auto">← Keluar</button>
                </div>
              </div>

              <!-- Content -->
              <div class="lg:col-span-3">

                <!-- Main Settings -->
                <template v-if="pengaturanView === 'main'">
                  <div class="bg-white rounded-[24px] border border-gray-200 shadow-sm divide-y divide-gray-100">
                    <!-- Profil -->
                    <div class="flex items-center justify-between px-6 py-5">
                      <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-blue-50 flex items-center justify-center text-lg">👤</div>
                        <div>
                          <p class="text-sm font-black text-gray-900">Isyana Randini</p>
                          <p class="text-[10px] text-gray-400 font-medium">✉️ isyanarandinitutor@gmail.com</p>
                        </div>
                      </div>
                      <button @click="pengaturanView = 'profil'" type="button" class="px-5 py-2 rounded-xl text-xs font-bold border-2 border-[#2563EB] text-[#2563EB] hover:bg-blue-50 transition">Edit Profil</button>
                    </div>
                    <!-- Keamanan -->
                    <div class="flex items-center justify-between px-6 py-5">
                      <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-emerald-50 flex items-center justify-center text-lg">🔒</div>
                        <div>
                          <p class="text-sm font-black text-gray-900">Keamanan</p>
                          <p class="text-[10px] text-gray-400 font-medium">Ubah dan atur keamanan akun kamu.</p>
                        </div>
                      </div>
                      <button @click="pengaturanView = 'password'" type="button" class="px-5 py-2 rounded-xl text-xs font-bold border-2 border-[#2563EB] text-[#2563EB] hover:bg-blue-50 transition">Ganti Kata Sandi</button>
                    </div>
                    <!-- Aktivitas Login -->
                    <div class="flex items-center justify-between px-6 py-5">
                      <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-amber-50 flex items-center justify-center text-lg">📱</div>
                        <div>
                          <p class="text-sm font-black text-gray-900">Aktivitas Login</p>
                          <p class="text-[10px] text-gray-400 font-medium">Ubah aktivitas login kamu.</p>
                        </div>
                      </div>
                    </div>
                    <!-- Notifikasi -->
                    <div class="flex items-center justify-between px-6 py-5">
                      <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-purple-50 flex items-center justify-center text-lg">🔔</div>
                        <div>
                          <p class="text-sm font-black text-gray-900">Notifikasi</p>
                          <p class="text-[10px] text-gray-400 font-medium">Atur notifikasi akun kamu.</p>
                        </div>
                      </div>
                      <button @click="pengaturanView = 'notifikasi'" type="button" class="px-5 py-2 rounded-xl text-xs font-bold border-2 border-[#2563EB] text-[#2563EB] hover:bg-blue-50 transition">Atur Notifikasi</button>
                    </div>
                    <!-- Bahasa -->
                    <div class="flex items-center justify-between px-6 py-5">
                      <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-cyan-50 flex items-center justify-center text-lg">🌐</div>
                        <div>
                          <p class="text-sm font-black text-gray-900">Bahasa</p>
                          <p class="text-[10px] text-gray-400 font-medium">Bahasa Indonesia</p>
                        </div>
                      </div>
                    </div>
                  </div>
                </template>

                <!-- Edit Profil -->
                <template v-else-if="pengaturanView === 'profil'">
                  <div class="bg-white rounded-[24px] border border-gray-200 p-6 shadow-sm">
                    <div class="mb-4">
                      <button @click="pengaturanView = 'main'" type="button" class="text-xs font-bold text-gray-500 hover:text-gray-700 transition inline-flex items-center gap-1">← Kembali ke Pengaturan</button>
                    </div>
                    <div class="space-y-5">
                      <div>
                        <label class="text-xs font-bold text-gray-700 mb-1.5 block">Nama Lengkap *</label>
                        <div class="flex items-center gap-3 px-4 py-2.5 rounded-xl border border-gray-200">
                          <span class="text-gray-400">👤</span>
                          <input type="text" value="Isyana Randini" class="flex-1 text-sm font-medium text-gray-700 focus:outline-none">
                        </div>
                      </div>
                      <div>
                        <label class="text-xs font-bold text-gray-700 mb-1.5 block">Alamat Email *</label>
                        <div class="flex items-center gap-3 px-4 py-2.5 rounded-xl border border-gray-200">
                          <span class="text-gray-400">✉️</span>
                          <input type="email" value="isyanarandinitutor@gmail.com" class="flex-1 text-sm font-medium text-gray-700 focus:outline-none">
                        </div>
                      </div>
                      <div>
                        <label class="text-xs font-bold text-gray-700 mb-1.5 block">Nomor Telepon *</label>
                        <div class="flex items-center gap-3 px-4 py-2.5 rounded-xl border border-gray-200">
                          <span class="text-gray-400">📞</span>
                          <input type="tel" value="087793648260" class="flex-1 text-sm font-medium text-gray-700 focus:outline-none">
                        </div>
                      </div>
                      <div>
                        <label class="text-xs font-bold text-gray-700 mb-1.5 block">Alamat Rumah *</label>
                        <div class="flex items-center gap-3 px-4 py-2.5 rounded-xl border border-gray-200">
                          <span class="text-gray-400">🏠</span>
                          <input type="text" value="Jln Cung Wanara" class="flex-1 text-sm font-medium text-gray-700 focus:outline-none">
                        </div>
                      </div>
                      <div>
                        <label class="text-xs font-bold text-gray-700 mb-1.5 block">Tentang Saya *</label>
                        <div class="flex items-start gap-3 px-4 py-2.5 rounded-xl border border-gray-200">
                          <span class="text-gray-400 mt-0.5">✍️</span>
                          <textarea rows="3" class="flex-1 text-sm font-medium text-gray-700 focus:outline-none resize-none">Halo! Saya Isyana Randini, saya mengajar matematika di bidang transformasi geometri, aljabar.</textarea>
                        </div>
                      </div>
                      <div class="flex justify-end pt-2">
                        <button type="button" class="bg-[#2563EB] text-white px-6 py-3 rounded-xl font-bold text-sm hover:bg-blue-700 transition shadow-sm">Simpan Perubahan</button>
                      </div>
                    </div>
                  </div>
                </template>

                <!-- Ganti Kata Sandi -->
                <template v-else-if="pengaturanView === 'password'">
                  <div class="bg-white rounded-[24px] border border-gray-200 p-6 shadow-sm">
                    <div class="mb-4">
                      <button @click="pengaturanView = 'main'" type="button" class="text-xs font-bold text-gray-500 hover:text-gray-700 transition inline-flex items-center gap-1">← Kembali ke Pengaturan</button>
                    </div>
                    <div class="space-y-5 max-w-md">
                      <div>
                        <label class="text-xs font-bold text-gray-700 mb-1.5 block">Kata Sandi Lama *</label>
                        <div class="flex items-center gap-3 px-4 py-2.5 rounded-xl border border-gray-200">
                          <span class="text-gray-400">🔒</span>
                          <input type="password" placeholder="Masukkan kata sandi lama" class="flex-1 text-sm font-medium text-gray-700 focus:outline-none">
                        </div>
                      </div>
                      <div>
                        <label class="text-xs font-bold text-gray-700 mb-1.5 block">Kata Sandi Baru *</label>
                        <div class="flex items-center gap-3 px-4 py-2.5 rounded-xl border border-gray-200">
                          <span class="text-gray-400">🔑</span>
                          <input type="password" placeholder="Masukkan kata sandi baru" class="flex-1 text-sm font-medium text-gray-700 focus:outline-none">
                        </div>
                        <p class="text-[10px] text-gray-400 font-medium mt-1.5">Minimal 8 karakter, huruf besar, huruf kecil, dan angka.</p>
                      </div>
                      <div>
                        <label class="text-xs font-bold text-gray-700 mb-1.5 block">Konfirmasi Kata Sandi Baru *</label>
                        <div class="flex items-center gap-3 px-4 py-2.5 rounded-xl border border-gray-200">
                          <span class="text-gray-400">🔑</span>
                          <input type="password" placeholder="Ulangi kata sandi baru" class="flex-1 text-sm font-medium text-gray-700 focus:outline-none">
                        </div>
                      </div>
                      <div class="flex justify-end pt-2">
                        <button type="button" class="bg-[#2563EB] text-white px-6 py-3 rounded-xl font-bold text-sm hover:bg-blue-700 transition shadow-sm">Ubah Kata Sandi</button>
                      </div>
                    </div>
                  </div>
                </template>

                <!-- Atur Notifikasi -->
                <template v-else-if="pengaturanView === 'notifikasi'">
                  <div class="bg-white rounded-[24px] border border-gray-200 p-6 shadow-sm">
                    <div class="mb-4">
                      <button @click="pengaturanView = 'main'" type="button" class="text-xs font-bold text-gray-500 hover:text-gray-700 transition inline-flex items-center gap-1">← Kembali ke Pengaturan</button>
                    </div>
                    <div class="space-y-1 divide-y divide-gray-100">
                      <div v-for="n in notifSettings" :key="n.id" class="flex items-center justify-between py-4">
                        <div class="flex items-center gap-3">
                          <div class="w-10 h-10 rounded-xl flex items-center justify-center text-lg" :class="n.iconBg">{{ n.icon }}</div>
                          <div>
                            <p class="text-sm font-bold text-gray-900">{{ n.title }}</p>
                            <p class="text-[10px] text-gray-400 font-medium">{{ n.desc }}</p>
                          </div>
                        </div>
                        <button @click="n.active = !n.active" type="button" class="relative w-12 h-7 rounded-full transition-colors duration-300" :class="n.active ? 'bg-[#2563EB]' : 'bg-gray-200'">
                          <span class="absolute top-0.5 w-6 h-6 rounded-full bg-white shadow transition-all duration-300" :class="n.active ? 'left-[22px]' : 'left-0.5'"></span>
                        </button>
                      </div>
                    </div>
                    <div class="flex justify-end pt-4 mt-4 border-t border-gray-100">
                      <button type="button" class="bg-[#2563EB] text-white px-6 py-3 rounded-xl font-bold text-sm hover:bg-blue-700 transition shadow-sm">Simpan Pengaturan</button>
                    </div>
                  </div>
                </template>

              </div>
            </div>
          </div>
</template>

<script setup>
import { reactive, ref } from 'vue'
const pengaturanView = ref('main')
const notifSettings = reactive([
  { id: 1, title: 'Pesan Baru', desc: 'Notifikasi saat ada pesan dari siswa.', icon: '💬', iconBg: 'bg-blue-50', active: true },
  { id: 2, title: 'Jadwal Mengajar', desc: 'Pengingat sesi mengajar yang akan datang.', icon: '📅', iconBg: 'bg-emerald-50', active: true },
  { id: 3, title: 'Pembayaran', desc: 'Notifikasi saat ada pembayaran masuk.', icon: '💰', iconBg: 'bg-amber-50', active: true },
  { id: 4, title: 'Ulasan Baru', desc: 'Notifikasi saat siswa memberikan ulasan.', icon: '⭐', iconBg: 'bg-purple-50', active: false },
  { id: 5, title: 'Permintaan Siswa', desc: 'Notifikasi saat ada siswa baru yang mendaftar.', icon: '👤', iconBg: 'bg-cyan-50', active: true },
  { id: 6, title: 'Update Sistem', desc: 'Pemberitahuan pembaruan dan fitur baru.', icon: '🔔', iconBg: 'bg-red-50', active: false },
])
</script>
