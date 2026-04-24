<template>
  <Head :title="pageTitle" />

  <div class="flex h-screen bg-[#F0F2F5] font-sans overflow-hidden">

    <aside class="w-64 bg-white flex flex-col border-r border-gray-100 shrink-0">
      <div class="p-6 flex items-center gap-3">
        <div class="text-green-500 text-3xl">🌱</div>
        <div>
          <h1 class="text-xl font-extrabold text-[#10B981] leading-none">LesGo</h1>
          <p class="text-[9px] text-gray-400 font-medium">Digital Tutoring Ecosystem</p>
        </div>
      </div>

      <nav class="flex-1 px-4 py-4 space-y-1">
        <button
          v-for="item in sideNav"
          :key="item.id"
          type="button"
          class="w-full flex items-center gap-3 px-4 py-3 rounded-xl text-left transition"
          :class="activeSection === item.id
            ? 'bg-[#3B82F6] text-white font-bold shadow-sm'
            : 'text-gray-500 hover:bg-gray-50 font-medium'"
          @click="goNav(item.id)"
        >
          <span class="text-lg leading-none w-6 text-center shrink-0">{{ item.icon }}</span>
          <span>{{ item.name }}</span>
        </button>
      </nav>
    </aside>

    <main class="flex-1 flex flex-col overflow-hidden">

      <header class="bg-white px-8 py-4 flex items-center justify-between border-b border-gray-50">
        <div class="flex-1 max-w-2xl relative">
          <span class="absolute inset-y-0 left-4 flex items-center text-gray-400">🔍</span>
          <input type="text" placeholder="Cari tutor / mata pelajaran" class="w-full bg-[#F3F4F6] border-none rounded-xl py-3 pl-12 pr-4 text-sm focus:ring-2 focus:ring-blue-100">
        </div>

        <div class="flex items-center gap-3 ml-6">
          <div class="text-right">
            <p class="text-sm font-bold text-gray-900">Kenzo Aliza</p>
            <p class="text-[10px] text-gray-500 font-medium uppercase tracking-wider">Siswa</p>
          </div>
          <div class="w-10 h-10 bg-orange-200 rounded-full border-2 border-white shadow-sm overflow-hidden flex items-center justify-center">
            👦🏽
          </div>
        </div>
      </header>

      <div class="flex-1 overflow-y-auto p-8 space-y-6">

        <!-- ——— Beranda ——— -->
        <template v-if="activeSection === 'beranda'">

        <div class="grid grid-cols-12 gap-6">
          <div class="col-span-8 bg-gradient-to-r from-[#0EA5E9] to-[#3B82F6] rounded-[32px] p-10 flex justify-between items-center text-white relative overflow-hidden">
            <div class="z-10 max-w-md">
              <h2 class="text-4xl font-black mb-3">Halo, Kenzo! <br> Siap belajar hari ini?</h2>
              <p class="text-blue-50 font-medium mb-8 text-sm opacity-90">Pilih pelajaranmu atau tutor terbaik untuk mulai belajar.</p>
              <button type="button" class="bg-[#1A56DB] hover:bg-blue-800 px-8 py-3 rounded-xl font-bold text-sm inline-flex items-center gap-2 transition shadow-lg">
                Lihat Materi
                <span aria-hidden="true">→</span>
              </button>
            </div>
            <div class="absolute right-10 bottom-0 w-48 h-48 opacity-90">
               <span class="text-[120px]">👧🏽</span>
            </div>
          </div>

          <div class="col-span-4 bg-white rounded-[32px] p-6 border border-gray-100 shadow-sm flex flex-col">
            <div class="flex justify-between items-center mb-6">
              <h3 class="font-bold text-gray-900 flex items-center gap-2">🔔 Notifikasi</h3>
              <a href="#" class="text-xs text-gray-400 font-bold hover:text-blue-600 transition">Lihat Semua</a>
            </div>
            <div class="space-y-6">
              <div class="flex gap-4 items-start">
                <div class="w-10 h-10 bg-blue-50 rounded-xl flex items-center justify-center text-lg">📁</div>
                <div>
                  <p class="text-[13px] font-bold text-gray-800 leading-tight">Tugas Baru</p>
                  <p class="text-[11px] text-gray-500 mt-1">Tutor Rian menambahkan tugas baru untuk kamu</p>
                  <p class="text-[10px] text-blue-500 font-bold mt-1">2 menit lalu</p>
                </div>
              </div>
              <div class="flex gap-4 items-start">
                <div class="w-10 h-10 bg-blue-50 rounded-xl flex items-center justify-center text-lg">📖</div>
                <div>
                  <p class="text-[13px] font-bold text-gray-800 leading-tight">Pengumpulan Tugas</p>
                  <p class="text-[11px] text-gray-500 mt-1">Kumpulkan tugas Bahasa Indonesia hari ini!</p>
                  <p class="text-[10px] text-blue-500 font-bold mt-1">2 jam lalu</p>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="grid grid-cols-12 gap-6">
          <div class="col-span-4 bg-white rounded-[32px] p-6 border border-gray-100 shadow-sm">
            <div class="flex justify-between items-center mb-6">
              <h3 class="font-bold text-gray-900 flex items-center gap-2">📖 Jadwal Hari Ini</h3>
              <a href="#" class="text-xs text-gray-400 font-bold">Lihat Semua</a>
            </div>
            <div class="space-y-4">
              <div v-for="j in jadwal" :key="j.id" class="flex items-center gap-4 p-3 bg-white rounded-2xl hover:bg-gray-50 border border-gray-50 transition">
                <div class="w-10 h-10 bg-gray-100 rounded-full flex items-center justify-center text-lg">{{ j.img }}</div>
                <div>
                  <h4 class="text-[13px] font-bold text-[#3B82F6] leading-none mb-1">{{ j.subject }}</h4>
                  <p class="text-[11px] text-gray-500 font-medium">Tutor {{ j.tutor }}</p>
                  <p class="text-[10px] text-gray-400 mt-0.5">{{ j.time }}</p>
                </div>
              </div>
            </div>
          </div>

          <div class="col-span-3 bg-white rounded-[32px] p-6 border border-gray-100 shadow-sm">
            <div class="flex justify-between items-center mb-6">
              <h3 class="font-bold text-gray-900 flex items-center gap-2">📓 Tugas</h3>
              <a href="#" class="text-xs text-gray-400 font-bold">Lihat Semua</a>
            </div>
            <div class="space-y-5">
              <div v-for="t in tugas" :key="t.id" class="flex items-center gap-4">
                <div class="w-10 h-10 bg-indigo-50 rounded-xl flex items-center justify-center text-lg">{{ t.icon }}</div>
                <div>
                  <h4 class="text-[13px] font-bold text-gray-800 leading-none mb-1">{{ t.subject }}</h4>
                  <p class="text-[10px] text-gray-500 font-medium">{{ t.desc }}</p>
                  <p class="text-[10px] text-gray-400 mt-1 font-bold italic">{{ t.posted }}</p>
                </div>
              </div>
            </div>
          </div>

          <div class="col-span-5 bg-white rounded-[32px] p-6 border border-gray-100 shadow-sm">
             <div class="flex justify-between items-center mb-6">
                <h3 class="font-bold text-gray-900 flex items-center gap-2">📅 Februari 2026</h3>
                <div class="flex gap-2">
                   <button class="w-6 h-6 border rounded-md text-gray-400 hover:bg-gray-50">‹</button>
                   <button class="w-6 h-6 border rounded-md text-gray-400 hover:bg-gray-50">›</button>
                </div>
             </div>
             <div class="grid grid-cols-7 text-center text-[10px] text-gray-400 font-bold mb-4 uppercase">
                <span>Min</span><span>Sen</span><span>Sel</span><span>Rab</span><span>Kam</span><span>Jum</span><span>Sab</span>
             </div>
             <div class="grid grid-cols-7 text-center gap-y-2">
                <div v-for="day in 28" :key="day" :class="day === 15 ? 'bg-blue-500 text-white rounded-full' : 'text-gray-500 hover:bg-gray-50 rounded-full'" class="py-2 text-[11px] font-bold cursor-pointer">
                   {{ day }}
                </div>
             </div>
          </div>
        </div>

        <section class="bg-white rounded-[32px] p-6 border border-gray-100 shadow-sm">
          <div class="flex justify-between items-center mb-6">
            <h3 class="font-bold text-gray-900 flex items-center gap-2">📊 Progres</h3>
            <a href="#" class="text-xs text-gray-400 font-bold hover:text-blue-600 transition">Lihat Semua</a>
          </div>
          <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
            <div
              v-for="p in progres"
              :key="p.id"
              class="rounded-2xl border border-gray-100 bg-[#FAFBFC] p-5 hover:shadow-md transition-shadow"
            >
              <h4 class="text-sm font-bold text-[#3B82F6] leading-tight">{{ p.subject }}</h4>
              <p class="text-xs text-gray-600 font-medium mt-2">{{ p.topic }}</p>
              <p class="text-[11px] text-gray-500 mt-1">Tutor {{ p.tutor }}</p>
              <p class="text-[10px] text-gray-400 mt-0.5">{{ p.schedule }}</p>
              <div class="mt-4">
                <div class="flex justify-between items-center text-[11px] font-bold text-gray-600 mb-1.5">
                  <span>Progres</span>
                  <span>{{ p.percent }}%</span>
                </div>
                <div class="h-2 rounded-full bg-gray-200 overflow-hidden">
                  <div
                    class="h-full rounded-full bg-gradient-to-r from-[#3B82F6] to-[#0EA5E9] transition-all"
                    :style="{ width: `${p.percent}%` }"
                  />
                </div>
              </div>
            </div>
          </div>
        </section>

        </template>

        <!-- ——— Kelas Saya ——— -->
        <template v-else-if="activeSection === 'kelas'">
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
                    class="bg-white rounded-[28px] border border-gray-100 shadow-[0_8px_30px_rgb(0,0,0,0.06)] p-6 flex flex-col"
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

        <!-- ——— Tugas Saya ——— -->
        <template v-else-if="activeSection === 'tugas'">
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

        <!-- ——— Tutor Saya ——— -->
        <template v-else-if="activeSection === 'tutor'">
          <div class="max-w-6xl mx-auto w-full space-y-5">
            <section class="bg-[#BFE4F8] rounded-xl border border-blue-100 p-6">
              <h2 class="text-4xl font-black text-gray-900">Tutor Saya</h2>
              <p class="text-sm text-gray-600 mt-2">Lihat tutor yang sudah mengkonfirmasi dan chat tutor.</p>
            </section>

            <section class="bg-white rounded-2xl border border-gray-200 shadow-sm p-4">
              <div class="flex items-center justify-between mb-4">
                <div class="inline-flex rounded-lg bg-gray-100 p-1">
                  <button
                    v-for="tab in tutorTabs"
                    :key="tab.id"
                    type="button"
                    class="px-4 py-2 rounded-md text-sm font-bold transition"
                    :class="tutorFilter === tab.id
                      ? 'bg-[#2563EB] text-white'
                      : 'text-gray-600 hover:text-gray-800'"
                    @click="tutorFilter = tab.id"
                  >
                    {{ tab.label }}
                  </button>
                </div>
                <button
                  type="button"
                  class="w-9 h-9 rounded-lg border border-gray-200 bg-white text-gray-500 hover:bg-gray-50 flex items-center justify-center"
                  aria-label="Filter tutor"
                >
                  ☰
                </button>
              </div>

              <div class="rounded-lg border border-amber-100 bg-amber-50 px-4 py-2.5 text-xs font-bold text-amber-700 mb-3">
                {{ tutorFilter === 'menunggu' ? 'Menunggu Konfirmasi Tutor' : 'Tutor Terkonfirmasi' }}
              </div>

              <div v-if="filteredTutorSaya.length" class="space-y-3">
                <article
                  v-for="tutor in filteredTutorSaya"
                  :key="tutor.id"
                  class="rounded-xl border border-gray-200 p-4"
                >
                  <div class="flex items-start justify-between gap-4">
                    <div class="flex items-start gap-3 min-w-0">
                      <div class="w-14 h-14 rounded-full bg-gray-100 flex items-center justify-center text-2xl shrink-0">{{ tutor.avatar }}</div>
                      <div class="min-w-0">
                        <h4 class="text-xl font-black text-gray-800">{{ tutor.name }}</h4>
                        <p class="text-sm text-amber-500 font-semibold">★ ★ ★ ★ ★</p>
                        <p class="text-xs text-gray-500 mt-1">📍 {{ tutor.location }}</p>
                        <p class="text-xs text-gray-500 mt-1">🧑‍🏫 {{ tutor.method }}</p>
                      </div>
                    </div>

                    <div class="flex flex-col items-end gap-2">
                      <span
                        class="text-[10px] font-bold px-2.5 py-1 rounded-full"
                        :class="tutor.status === 'confirmed'
                          ? 'bg-emerald-100 text-emerald-700'
                          : 'bg-amber-100 text-amber-700'"
                      >
                        {{ tutor.status === 'confirmed' ? 'Terkonfirmasi' : 'Menunggu Konfirmasi' }}
                      </span>

                      <button
                        v-if="tutor.status === 'pending'"
                        type="button"
                        class="px-3 py-1.5 rounded-lg text-xs font-bold border border-red-300 text-red-500 hover:bg-red-50"
                      >
                        Batalkan Permintaan
                      </button>
                      <div v-else class="flex gap-2">
                        <button
                          type="button"
                          class="px-3 py-1.5 rounded-lg text-xs font-bold border border-blue-200 text-[#2563EB] hover:bg-blue-50"
                        >
                          Lihat Profil
                        </button>
                        <button
                          type="button"
                          class="px-3 py-1.5 rounded-lg text-xs font-bold bg-[#2563EB] text-white hover:bg-blue-700"
                        >
                          Chat Tutor
                        </button>
                      </div>
                    </div>
                  </div>
                </article>
              </div>

              <div v-else class="rounded-xl border border-dashed border-gray-300 py-10 px-6 text-center">
                <p class="text-sm font-bold text-gray-600">Belum ada data tutor pada tab ini.</p>
                <p class="text-xs text-gray-400 mt-1">Coba pilih tab lain atau kirim permintaan tutor baru.</p>
              </div>

              <p class="text-xs text-gray-400 mt-4">
                Total tutor:
                <span class="font-bold text-gray-600">{{ filteredTutorSaya.length }}</span>
              </p>
            </section>
          </div>
        </template>

        <!-- ——— Cari Tutor ——— -->
        <template v-else-if="activeSection === 'cari'">
          <div class="max-w-6xl mx-auto w-full space-y-6">
            
            <template v-if="cariView === 'semua'">
            <!-- Header Section -->
            <div class="mb-8">
              <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
                <div>
                  <h2 class="text-3xl font-black text-gray-900 mb-2">Cari Tutor</h2>
                  <p class="text-gray-500 font-medium">Cari tutor terbaik dan terdekat sesuai kebutuhanmu.</p>
                  <p class="text-gray-500 font-medium">Lihat profil tutor dan mulai sesi belajarmu.</p>
                </div>
                <button @click="cariView = 'lokasi'" type="button" class="bg-[#2563EB] text-white px-6 py-3 rounded-xl font-bold text-sm inline-flex items-center gap-2 shadow-sm hover:bg-blue-700 transition">
                  📍 Cari Tutor Terdekat
                </button>
              </div>
            </div>

            <!-- Filters -->
            <div class="flex items-center gap-2 mb-6">
              <div class="flex items-center rounded-xl bg-white border border-gray-200 p-1 overflow-x-auto">
                <button
                  v-for="cat in cariTutorCategories"
                  :key="cat"
                  type="button"
                  class="px-5 py-2.5 rounded-lg text-sm font-bold whitespace-nowrap transition"
                  :class="cariTutorFilter === cat
                    ? 'bg-[#2563EB] text-white shadow-sm'
                    : 'text-gray-600 hover:text-gray-800'"
                  @click="cariTutorFilter = cat"
                >
                  {{ cat }}
                </button>
              </div>
              <button
                type="button"
                class="w-11 h-11 shrink-0 rounded-xl border border-gray-200 bg-white text-gray-500 hover:bg-gray-50 flex items-center justify-center shadow-sm"
              >
                <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path>
                </svg>
              </button>
            </div>

            <!-- Tutors Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
              <article
                v-for="(tutor, index) in filteredCariTutor"
                :key="tutor.id"
                class="bg-white rounded-[24px] border border-gray-200 shadow-sm p-6 flex flex-col hover:shadow-md transition"
                :class="{ 'border-2 border-blue-500 shadow-blue-100': index === 0 }"
              >
                <!-- Top Row: Avatar & Info -->
                <div class="flex items-start gap-5 mb-4">
                  <div class="w-16 h-16 rounded-full bg-blue-50 flex items-center justify-center text-3xl shrink-0 overflow-hidden border border-gray-100 shadow-inner">
                    <img :src="`https://ui-avatars.com/api/?name=${tutor.name.replace(' ', '+')}&background=eff6ff&color=2563eb`" alt="Avatar" class="w-full h-full object-cover" />
                  </div>
                  <div>
                    <h3 class="text-lg font-black text-[#2563EB] leading-tight">{{ tutor.name }}</h3>
                    <p class="text-xs font-bold text-gray-500 mt-0.5">{{ tutor.subject }}</p>
                    <p class="text-[11px] text-gray-400 mt-1 font-semibold flex items-center gap-1">🎓 {{ tutor.target }}</p>
                    <div class="flex items-center gap-1 mt-1.5 text-xs font-bold">
                      <span class="text-amber-400 text-sm tracking-widest">⭐⭐⭐⭐⭐</span>
                      <span class="text-gray-600 ml-1">{{ tutor.rating }}</span>
                    </div>
                  </div>
                </div>

                <!-- Middle Row: Description -->
                <p class="text-xs text-gray-500 leading-relaxed line-clamp-3 mb-6">
                  {{ tutor.description }}
                </p>

                <!-- Bottom Row: Button -->
                <div class="mt-auto">
                  <button
                    @click="cariView = 'profil'"
                    type="button"
                    class="w-full py-2.5 rounded-xl text-sm font-bold border-2 border-[#2563EB] text-[#2563EB] hover:bg-blue-50 transition"
                  >
                    Lihat Profil
                  </button>
                </div>
              </article>
            </div>

            <!-- Pagination (Mock) -->
            <div class="flex justify-center items-center gap-2 mt-8 pb-4">
              <button class="w-9 h-9 rounded-lg flex items-center justify-center bg-[#2563EB] text-white font-bold shadow-sm">1</button>
              <button class="w-9 h-9 rounded-lg flex items-center justify-center bg-white border border-gray-200 text-gray-600 hover:bg-gray-50 transition font-medium">2</button>
              <button class="w-9 h-9 rounded-lg flex items-center justify-center bg-white border border-gray-200 text-gray-600 hover:bg-gray-50 transition font-medium">3</button>
              <button class="w-9 h-9 rounded-lg flex items-center justify-center bg-white border border-gray-200 text-gray-600 hover:bg-gray-50 transition font-medium">4</button>
              <button class="w-9 h-9 rounded-lg flex items-center justify-center bg-white border border-gray-200 text-gray-600 hover:bg-gray-50 transition font-medium">5</button>
              <button class="w-9 h-9 rounded-lg flex items-center justify-center bg-white border border-gray-200 text-gray-500 hover:bg-gray-50 transition">›</button>
            </div>
            </template>

            <template v-else-if="cariView === 'profil'">
              <!-- Profil View -->
              <div class="animate-fade-in">
                <!-- Back Button -->
                <div class="mb-6">
                  <button @click="cariView = 'semua'" type="button" class="bg-white border border-gray-200 text-gray-700 px-4 py-2 rounded-lg font-bold text-sm inline-flex items-center gap-2 hover:bg-gray-50 transition shadow-sm">
                    <span aria-hidden="true">←</span> Kembali
                  </button>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                  <!-- Left Column: Profile Details -->
                  <div class="lg:col-span-2 bg-white rounded-[24px] border border-gray-200 p-8 shadow-sm flex flex-col">
                    <!-- Header -->
                    <div class="flex flex-col md:flex-row gap-8 items-start">
                      <div class="w-32 h-32 rounded-full overflow-hidden bg-blue-50 shrink-0 border-4 border-white shadow-md">
                        <img src="https://ui-avatars.com/api/?name=Isyana+Randini&background=eff6ff&color=2563eb&size=256" alt="Isyana Randini" class="w-full h-full object-cover">
                      </div>
                      <div class="pt-2">
                        <h2 class="text-3xl font-black text-gray-900 mb-2">Isyana Randini</h2>
                        <div class="flex items-center gap-1 mb-3">
                          <span class="text-amber-400 text-lg">⭐⭐⭐⭐⭐</span>
                        </div>
                        <div class="space-y-2">
                          <p class="flex items-center gap-2 text-sm font-bold text-gray-500">
                            <span class="w-5 text-center text-lg">📚</span> Matematika
                          </p>
                          <p class="flex items-center gap-2 text-sm font-bold text-gray-500">
                            <span class="w-5 text-center text-lg">📍</span> Denpasar Selatan
                          </p>
                        </div>
                      </div>
                    </div>

                    <!-- Description Box -->
                    <div class="mt-8 bg-[#F5F7FF] rounded-2xl p-5">
                      <p class="text-sm text-gray-600 leading-relaxed font-medium">
                        <span class="font-bold text-gray-800">Tutor berpengalaman mengajar SD-SMA.</span> Spesialis dalam aljabar, geometri, dan trigonometri. Sabar dan membuat belajar jadi menyenangkan!
                      </p>
                    </div>

                    <!-- Details List -->
                    <div class="mt-8 space-y-6">
                      <!-- Kursus -->
                      <div>
                        <h4 class="flex items-center gap-2 text-base font-bold text-gray-900 mb-3">
                          <span class="text-emerald-500 text-xl">☑</span> Kursus yang diajarkan
                        </h4>
                        <div class="ml-7 space-y-2">
                          <p class="flex items-center gap-2 text-sm font-bold text-gray-500">
                            <span class="text-gray-400">🎓</span> SD - SMA
                          </p>
                          <p class="flex items-center gap-2 text-sm font-bold text-gray-500">
                            <span class="text-gray-400">📚</span> Matematika
                          </p>
                        </div>
                      </div>

                      <!-- Pengalaman -->
                      <div>
                        <h4 class="flex items-center gap-2 text-base font-bold text-gray-900 mb-3">
                          <span class="text-emerald-500 text-xl">☑</span> Pengalaman Mengajar
                        </h4>
                        <div class="ml-7">
                          <p class="flex items-center gap-2 text-sm font-bold text-gray-500">
                            <span class="text-gray-400">⏱</span> 10 Tahun mengajar matematika
                          </p>
                        </div>
                      </div>

                      <!-- Preferensi Lokasi -->
                      <div>
                        <h4 class="flex items-center gap-2 text-base font-bold text-gray-900 mb-3">
                          <span class="text-emerald-500 text-xl">☑</span> Preferensi Lokasi Mengajar
                        </h4>
                        <div class="ml-7 space-y-2">
                          <p class="flex items-center gap-2 text-sm font-bold text-gray-500">
                            <span class="text-gray-400">📍</span> Datangi rumah siswa sekitar Denpasar Selatan
                          </p>
                          <p class="flex items-center gap-2 text-sm font-bold text-gray-500">
                            <span class="text-gray-400">💻</span> Online zoom/Google Meet
                          </p>
                        </div>
                      </div>
                    </div>
                  </div>

                  <!-- Right Column: Map & Pricing -->
                  <div class="lg:col-span-1 space-y-6">
                    <!-- Map Card -->
                    <div class="bg-white rounded-[24px] border border-gray-200 p-4 shadow-sm">
                      <div class="relative w-full h-56 rounded-xl overflow-hidden bg-gray-100 mb-4 border border-gray-100">
                        <!-- OpenStreetMap -->
                        <iframe 
                          class="absolute inset-0 w-full h-full"
                          frameborder="0" 
                          scrolling="no" 
                          marginheight="0" 
                          marginwidth="0" 
                          src="https://www.openstreetmap.org/export/embed.html?bbox=115.18%2C-8.72%2C115.28%2C-8.62&amp;layer=mapnik&amp;marker=-8.670%2C115.230">
                        </iframe>
                        <!-- Map Overlay (Pin) -->
                        <div class="absolute inset-0 pointer-events-none flex items-center justify-center">
                           <div class="w-48 h-48 rounded-full border-[4px] border-white shadow-[0_0_0_9999px_rgba(255,255,255,0.4)] flex items-center justify-center relative overflow-hidden">
                              <svg class="w-16 h-16 text-red-600 drop-shadow-md absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-full" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/>
                              </svg>
                           </div>
                        </div>
                        <!-- Lihat Lokasi Button -->
                        <button @click="cariView = 'lokasi_detail'" class="absolute bottom-3 right-3 bg-[#2563EB] text-white px-4 py-2 rounded-xl text-xs font-bold shadow-md hover:bg-blue-700 transition flex items-center gap-1">
                          📍 Lihat Lokasi
                        </button>
                      </div>
                      <p class="text-sm font-bold text-gray-700 flex items-center gap-2 px-2">
                        <span class="text-gray-400 text-lg">⏳</span> Sekitar 2 km dari rumah Anda
                      </p>
                    </div>

                    <!-- Pricing Card -->
                    <div class="bg-white rounded-[24px] border border-gray-200 p-6 shadow-sm">
                      <h3 class="text-lg font-black text-gray-900 mb-4">Biaya Mengajar</h3>
                      <div class="space-y-0">
                        <!-- Row 1 -->
                        <div class="flex justify-between items-center py-4 border-b border-gray-100">
                          <span class="text-sm font-bold text-gray-800">Privat di rumah</span>
                          <div class="text-right">
                            <span class="text-[11px] font-bold text-gray-400 block mb-0.5">1 Jam</span>
                            <span class="text-sm font-black text-gray-900">Rp100.000</span>
                          </div>
                        </div>
                        <!-- Row 2 -->
                        <div class="flex justify-between items-center py-4 border-b border-gray-100">
                          <span class="text-sm font-bold text-gray-800">Grup (2-4 Orang)</span>
                          <div class="text-right">
                            <span class="text-[11px] font-bold text-gray-400 block mb-0.5">1 Jam/orang</span>
                            <span class="text-sm font-black text-gray-900">Rp75.000</span>
                          </div>
                        </div>
                        <!-- Row 3 -->
                        <div class="flex justify-between items-center py-4">
                          <span class="text-sm font-bold text-gray-800">Online via Zoom/Meet</span>
                          <div class="text-right">
                            <span class="text-[11px] font-bold text-gray-400 block mb-0.5">1 Jam</span>
                            <span class="text-sm font-black text-gray-900">Rp80.000</span>
                          </div>
                        </div>
                      </div>

                      <button type="button" class="mt-4 w-full bg-[#2563EB] text-white py-3.5 rounded-xl text-sm font-bold shadow-sm hover:bg-blue-700 transition">
                        Hubungi Tutor
                      </button>
                    </div>
                  </div>
                </div>
              </div>
            </template>

            <template v-else-if="cariView === 'lokasi'">
              <!-- Map Radius Search View -->
              <div class="animate-fade-in">
                <!-- Back Button -->
                <div class="mb-4">
                  <button @click="cariView = 'semua'" type="button" class="bg-white border border-gray-200 text-gray-700 px-4 py-2 rounded-lg font-bold text-sm inline-flex items-center gap-2 hover:bg-gray-50 transition shadow-sm">
                    <span aria-hidden="true">←</span> Kembali
                  </button>
                </div>
                
                <p class="text-gray-500 font-medium mb-4">Ditemukan 4 tutor terdekat dalam 2 km</p>

                <!-- Main Card -->
                <div class="bg-white rounded-[24px] border border-gray-200 shadow-sm overflow-hidden flex flex-col">
                  
                  <!-- Top Filter Bar -->
                  <div class="p-6 border-b border-gray-100 flex flex-col md:flex-row md:items-center justify-between gap-6">
                    <!-- Slider Section -->
                    <div class="flex items-center gap-4 flex-1">
                      <span class="font-black text-gray-900 whitespace-nowrap">Radius: 2 km</span>
                      <div class="flex-1 relative flex items-center">
                        <div class="h-2 w-full bg-blue-100 rounded-full overflow-hidden">
                          <div class="h-full bg-[#2563EB] w-[20%]"></div>
                        </div>
                        <div class="absolute left-[20%] w-5 h-5 bg-orange-400 rounded-full border-[3px] border-white shadow-md transform -translate-x-1/2 cursor-pointer"></div>
                      </div>
                      <span class="font-black text-gray-900 whitespace-nowrap">15 km</span>
                    </div>

                    <!-- Dropdowns & Filter Button -->
                    <div class="flex items-center gap-3 w-full md:w-auto overflow-x-auto pb-2 md:pb-0">
                      <button type="button" class="flex items-center gap-2 px-4 py-2 border border-gray-200 rounded-full text-sm font-bold text-gray-700 hover:bg-gray-50 bg-white shadow-sm whitespace-nowrap">
                        <span class="text-gray-400">⎚</span> Semua <span class="text-gray-400 text-xs">▼</span>
                      </button>
                      <button type="button" class="flex items-center gap-2 px-4 py-2 border border-gray-200 rounded-full text-sm font-bold text-gray-700 hover:bg-gray-50 bg-white shadow-sm whitespace-nowrap">
                        <span class="text-blue-500">📘</span> Matematika <span class="text-gray-400 text-xs">▼</span>
                      </button>
                      <button type="button" class="flex items-center gap-2 px-6 py-2 bg-[#2563EB] text-white rounded-full text-sm font-bold shadow-sm hover:bg-blue-700 whitespace-nowrap ml-auto md:ml-2">
                        Filter <span aria-hidden="true">›</span>
                      </button>
                    </div>
                  </div>

                  <!-- Map Area -->
                  <div class="relative w-full h-[400px] bg-gray-100 overflow-hidden">
                    <!-- Real OpenStreetMap -->
                    <iframe 
                      class="absolute inset-0 w-full h-full"
                      frameborder="0" 
                      scrolling="no" 
                      marginheight="0" 
                      marginwidth="0" 
                      src="https://www.openstreetmap.org/export/embed.html?bbox=115.18%2C-8.72%2C115.28%2C-8.62&amp;layer=mapnik&amp;marker=-8.670%2C115.230">
                    </iframe>
                    
                    <!-- Map Overlays -->
                    <div class="absolute inset-0 pointer-events-none">
                      <!-- Central Pin & Circles -->
                      <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 flex items-center justify-center">
                        <!-- Circle 3 (Largest) -->
                        <div class="absolute w-[350px] h-[350px] rounded-full border-2 border-blue-200 bg-blue-50/10"></div>
                        <!-- Circle 2 -->
                        <div class="absolute w-[250px] h-[250px] rounded-full border-2 border-blue-300 bg-blue-50/20"></div>
                        <!-- Circle 1 (Smallest) -->
                        <div class="absolute w-[150px] h-[150px] rounded-full border-2 border-blue-400 bg-blue-100/30 flex items-center justify-center">
                          <div class="w-16 h-16 bg-blue-200/50 rounded-full flex items-center justify-center">
                             <!-- Pin -->
                             <svg class="w-12 h-12 text-red-600 drop-shadow-md transform -translate-y-4" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/>
                             </svg>
                          </div>
                        </div>
                      </div>

                      <!-- Tutor Floating Tags (Mock Positions) -->
                      <!-- Tutor 1 -->
                      <div class="absolute top-[20%] left-[30%] bg-white rounded-full p-1 pr-3 flex items-center gap-2 shadow-lg border border-gray-100">
                        <img src="https://ui-avatars.com/api/?name=Iqbal+M&background=eff6ff&color=2563eb" class="w-8 h-8 rounded-full">
                        <div>
                          <p class="text-xs font-black text-gray-900 leading-none">Iqbal</p>
                          <p class="text-[10px] font-bold text-gray-500 flex items-center mt-0.5"><span class="text-amber-400">⭐</span> 4.7</p>
                        </div>
                      </div>
                      
                      <!-- Tutor 2 -->
                      <div class="absolute top-[30%] right-[25%] bg-white rounded-full p-1 pr-3 flex items-center gap-2 shadow-lg border border-gray-100">
                        <img src="https://ui-avatars.com/api/?name=Alvian&background=eff6ff&color=2563eb" class="w-8 h-8 rounded-full">
                        <div>
                          <p class="text-xs font-black text-gray-900 leading-none">Alvian</p>
                          <p class="text-[10px] font-bold text-gray-500 flex items-center mt-0.5"><span class="text-amber-400">⭐</span> 4.9</p>
                        </div>
                      </div>

                      <!-- Tutor 3 -->
                      <div class="absolute bottom-[25%] left-[40%] bg-white rounded-full p-1 pr-3 flex items-center gap-2 shadow-lg border border-gray-100">
                        <img src="https://ui-avatars.com/api/?name=Alvian&background=eff6ff&color=2563eb" class="w-8 h-8 rounded-full">
                        <div>
                          <p class="text-xs font-black text-gray-900 leading-none">Alvian</p>
                          <p class="text-[10px] font-bold text-gray-500 flex items-center mt-0.5"><span class="text-amber-400">⭐</span> 4.9</p>
                        </div>
                      </div>

                      <!-- Tutor 4 -->
                      <div class="absolute bottom-[35%] right-[30%] bg-white rounded-full p-1 pr-3 flex items-center gap-2 shadow-lg border border-gray-100">
                        <img src="https://ui-avatars.com/api/?name=Tania&background=eff6ff&color=2563eb" class="w-8 h-8 rounded-full">
                        <div>
                          <p class="text-xs font-black text-gray-900 leading-none">Tania</p>
                          <p class="text-[10px] font-bold text-gray-500 flex items-center mt-0.5"><span class="text-amber-400">⭐</span> 4.6</p>
                        </div>
                      </div>
                    </div>
                  </div>

                  <!-- Tutor List -->
                  <div class="grid grid-cols-1 md:grid-cols-2 bg-white">
                    <!-- Left Column -->
                    <div class="flex flex-col md:border-r border-gray-200">
                      <!-- Row 1 -->
                      <div class="flex items-center justify-between p-4 border-b border-gray-200 hover:bg-gray-50 cursor-pointer transition" @click="cariView = 'profil'">
                        <div class="flex items-center gap-3">
                          <img src="https://ui-avatars.com/api/?name=Isyana+Randini&background=eff6ff&color=2563eb" class="w-12 h-12 rounded-full">
                          <div>
                            <h4 class="text-sm font-black text-gray-900">Isyana Randini</h4>
                            <div class="flex items-center gap-1 text-xs font-bold text-gray-500 mt-0.5">
                              <span class="text-amber-400">⭐⭐⭐⭐⭐</span> 4.7
                            </div>
                          </div>
                        </div>
                        <div class="text-xs font-bold text-gray-500 flex items-center gap-1">
                          <span class="text-gray-400">◎</span> 300m
                        </div>
                      </div>
                      <!-- Row 2 -->
                      <div class="flex items-center justify-between p-4 border-b border-gray-200 hover:bg-gray-50 cursor-pointer transition" @click="cariView = 'profil'">
                        <div class="flex items-center gap-3">
                          <img src="https://ui-avatars.com/api/?name=Iqbal+Mustofa&background=eff6ff&color=2563eb" class="w-12 h-12 rounded-full">
                          <div>
                            <h4 class="text-sm font-black text-gray-900">Iqbal Mustofa</h4>
                            <div class="flex items-center gap-1 text-xs font-bold text-gray-500 mt-0.5">
                              <span class="text-amber-400">⭐⭐⭐⭐⭐</span> 4.7
                            </div>
                          </div>
                        </div>
                        <div class="text-xs font-bold text-gray-500 flex items-center gap-1">
                          <span class="text-gray-400">◎</span> 350m
                        </div>
                      </div>
                      <!-- Row 3 -->
                      <div class="flex items-center justify-between p-4 border-b md:border-b-0 border-gray-200 hover:bg-gray-50 cursor-pointer transition" @click="cariView = 'profil'">
                        <div class="flex items-center gap-3">
                          <img src="https://ui-avatars.com/api/?name=Tania+Riana&background=eff6ff&color=2563eb" class="w-12 h-12 rounded-full">
                          <div>
                            <h4 class="text-sm font-black text-gray-900">Tania Riana</h4>
                            <div class="flex items-center gap-1 text-xs font-bold text-gray-500 mt-0.5">
                              <span class="text-amber-400">⭐⭐⭐⭐⭐</span> 4.7
                            </div>
                          </div>
                        </div>
                        <div class="text-xs font-bold text-gray-500 flex items-center gap-1">
                          <span class="text-gray-400">◎</span> 400m
                        </div>
                      </div>
                    </div>

                    <!-- Right Column -->
                    <div class="flex flex-col">
                      <!-- Row 1 -->
                      <div class="flex items-center justify-between p-4 border-b border-gray-200 hover:bg-gray-50 cursor-pointer transition" @click="cariView = 'profil'">
                        <div class="flex items-center gap-3">
                          <img src="https://ui-avatars.com/api/?name=Isyana+Randini&background=eff6ff&color=2563eb" class="w-12 h-12 rounded-full">
                          <div>
                            <h4 class="text-sm font-black text-gray-900">Isyana Randini</h4>
                            <div class="flex items-center gap-1 text-xs font-bold text-gray-500 mt-0.5">
                              <span class="text-amber-400">⭐⭐⭐⭐⭐</span> 4.7
                            </div>
                          </div>
                        </div>
                        <div class="text-xs font-bold text-gray-500 flex items-center gap-1">
                          <span class="text-gray-400">◎</span> 1.1km
                        </div>
                      </div>
                      <!-- Row 2 -->
                      <div class="flex items-center justify-between p-4 border-b border-gray-200 hover:bg-gray-50 cursor-pointer transition" @click="cariView = 'profil'">
                        <div class="flex items-center gap-3">
                          <img src="https://ui-avatars.com/api/?name=Iqbal+Mustofa&background=eff6ff&color=2563eb" class="w-12 h-12 rounded-full">
                          <div>
                            <h4 class="text-sm font-black text-gray-900">Iqbal Mustofa</h4>
                            <div class="flex items-center gap-1 text-xs font-bold text-gray-500 mt-0.5">
                              <span class="text-amber-400">⭐⭐⭐⭐⭐</span> 4.7
                            </div>
                          </div>
                        </div>
                        <div class="text-xs font-bold text-gray-500 flex items-center gap-1">
                          <span class="text-gray-400">◎</span> 1.3km
                        </div>
                      </div>
                      <!-- Row 3 -->
                      <div class="flex items-center justify-between p-4 border-b md:border-b-0 border-gray-200 hover:bg-gray-50 cursor-pointer transition" @click="cariView = 'profil'">
                        <div class="flex items-center gap-3">
                          <img src="https://ui-avatars.com/api/?name=Tania+Riana&background=eff6ff&color=2563eb" class="w-12 h-12 rounded-full">
                          <div>
                            <h4 class="text-sm font-black text-gray-900">Tania Riana</h4>
                            <div class="flex items-center gap-1 text-xs font-bold text-gray-500 mt-0.5">
                              <span class="text-amber-400">⭐⭐⭐⭐⭐</span> 4.7
                            </div>
                          </div>
                        </div>
                        <div class="text-xs font-bold text-gray-500 flex items-center gap-1">
                          <span class="text-gray-400">◎</span> 1.5km
                        </div>
                      </div>
                    </div>
                  </div>

                </div>
              </div>
            </template>

            <template v-else-if="cariView === 'lokasi_detail'">
            <!-- Lokasi Tutor View (Detail Map) -->
            <div class="animate-fade-in">
              <div class="mb-6">
                <button @click="cariView = 'profil'" type="button" class="bg-white border border-gray-200 text-gray-700 px-4 py-2 rounded-lg font-bold text-sm inline-flex items-center gap-2 hover:bg-gray-50 transition shadow-sm">
                  <span aria-hidden="true">←</span> Kembali
                </button>
              </div>
              <h2 class="text-3xl font-black mb-6 text-gray-900">Lokasi Tutor</h2>

              <!-- Map Container -->
              <div class="relative w-full h-[400px] rounded-2xl overflow-hidden border border-gray-200 shadow-sm bg-gray-100">
                <!-- Real OpenStreetMap -->
                <iframe 
                  class="absolute inset-0 w-full h-full"
                  frameborder="0" 
                  scrolling="no" 
                  marginheight="0" 
                  marginwidth="0" 
                  src="https://www.openstreetmap.org/export/embed.html?bbox=115.18%2C-8.72%2C115.28%2C-8.62&amp;layer=mapnik&amp;marker=-8.670%2C115.230">
                </iframe>
                
                <!-- Map UI Overlay: Circular Highlight -->
                <div class="absolute inset-0 flex items-center justify-center pointer-events-none">
                  <div class="w-64 h-64 rounded-full border-[6px] border-white shadow-[0_0_0_9999px_rgba(255,255,255,0.4)] flex items-center justify-center relative overflow-hidden">
                     <!-- Pin -->
                     <svg class="w-20 h-20 text-red-600 drop-shadow-xl absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-full" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/>
                     </svg>
                  </div>
                </div>

                <!-- Floating Map Buttons -->
                <div class="absolute bottom-6 right-6 flex flex-col gap-3">
                  <button type="button" class="bg-[#2563EB] text-white px-5 py-2.5 rounded-xl font-bold text-sm shadow-lg flex items-center gap-2 hover:bg-blue-700 transition">
                    📍 Buka di Google Maps
                  </button>
                  <button type="button" class="bg-white text-blue-600 px-5 py-2.5 rounded-xl font-bold text-sm shadow-lg flex items-center gap-2 hover:bg-gray-50 transition">
                    🔺 Rute ke Lokasi
                  </button>
                </div>
              </div>

              <!-- Details Container -->
              <div class="bg-white rounded-b-3xl border-x border-b border-gray-200 shadow-sm p-8 relative -mt-4 z-10 mx-2">
                
                <!-- Floating Tutor Card -->
                <div class="md:absolute md:-top-12 md:right-8 bg-white rounded-2xl border border-gray-100 shadow-[0_8px_30px_rgb(0,0,0,0.08)] p-5 flex gap-5 md:w-80 w-full mb-6 md:mb-0">
                  <div class="w-16 h-16 rounded-full bg-blue-50 overflow-hidden shrink-0 flex items-center justify-center text-3xl border border-blue-100">
                    <img src="https://ui-avatars.com/api/?name=Isyana+Randini&background=eff6ff&color=2563eb" alt="Tutor" class="w-full h-full object-cover">
                  </div>
                  <div>
                    <h4 class="text-xl font-black text-[#2563EB] leading-tight">Isyana Randini</h4>
                    <p class="text-xs font-bold text-gray-500 mt-1">Matematika</p>
                    <p class="text-[10px] text-gray-400 mt-1 font-semibold flex items-center gap-1">🎓 Tutor SD - SMA</p>
                    <div class="flex items-center gap-1 mt-2 text-xs font-bold">
                      <span class="text-amber-400 text-sm">⭐⭐⭐⭐⭐</span>
                      <span class="text-gray-600 ml-1">4.7</span>
                    </div>
                  </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                  <!-- Left Side: Methods & Info -->
                  <div class="space-y-8">
                    <div class="space-y-4">
                      <div class="flex items-center gap-3 text-sm font-bold text-gray-700">
                        <span class="text-gray-400 text-lg w-5 text-center">📍</span> Denpasar Selatan
                      </div>
                      <div class="flex items-center gap-3 text-sm font-bold text-gray-700">
                        <span class="text-gray-400 text-lg w-5 text-center">◎</span> Sekitar 2km dari rumah kamu
                      </div>
                    </div>

                    <div>
                      <h3 class="font-black text-gray-900 mb-5 text-lg">Pilih Metode Belajar</h3>
                      <div class="space-y-5">
                        <div class="flex items-start gap-4">
                          <span class="text-gray-400 text-xl w-5 text-center mt-0.5">🏠</span>
                          <div>
                            <p class="text-sm font-bold text-gray-800">Tutor datang ke rumah kamu</p>
                            <p class="text-xs font-bold text-[#2563EB] mt-1">Area: Denpasar Selatan</p>
                          </div>
                        </div>
                        <div class="flex items-start gap-4">
                          <span class="text-gray-400 text-xl w-5 text-center mt-0.5">💻</span>
                          <div>
                            <p class="text-sm font-bold text-gray-800">Online</p>
                            <p class="text-xs font-bold text-[#2563EB] mt-1">Zoom / Google Meet</p>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                  <!-- Right Side: Actions -->
                  <div class="flex flex-col justify-end items-end gap-3 md:pt-20">
                    <div class="flex flex-wrap gap-3 justify-end w-full">
                      <button type="button" class="bg-[#2563EB] text-white px-6 py-3 rounded-xl font-bold text-sm shadow-sm flex items-center gap-2 hover:bg-blue-700 transition">
                        📞 Hubungi Tutor
                      </button>
                      <button type="button" class="bg-[#2563EB] text-white px-6 py-3 rounded-xl font-bold text-sm shadow-sm flex items-center gap-2 hover:bg-blue-700 transition">
                        📅 Booking Sekarang
                      </button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            </template>

          </div>
        </template>

      </div>
    </main>
  </div>
</template>

<script setup>
import { computed, onBeforeUnmount, ref } from 'vue'
import { Head } from '@inertiajs/vue3'

const props = defineProps({
  japaneseClassData: {
    type: Object,
    default: null,
  },
})

const japaneseClassState = ref(props.japaneseClassData)
const activeSection = ref('beranda')

const sideNav = [
  { id: 'beranda', name: 'Beranda', icon: '▦' },
  { id: 'kelas', name: 'Kelas Saya', icon: '🎓' },
  { id: 'tugas', name: 'Tugas Saya', icon: '📝' },
  { id: 'tutor', name: 'Tutor Saya', icon: '👤' },
  { id: 'cari', name: 'Cari Tutor', icon: '🔍' },
  { id: 'progres', name: 'Progres', icon: '📊' },
  { id: 'pesan', name: 'Pesan', icon: '✉️' },
  { id: 'pengaturan', name: 'Pengaturan', icon: '⚙️' },
]

function goNav(id) {
  if (id === 'beranda' || id === 'kelas' || id === 'tugas' || id === 'tutor' || id === 'cari') {
    activeSection.value = id
    if (id === 'tugas') {
      tugasView.value = 'list'
    }
  }
}

const pageTitle = computed(() =>
  activeSection.value === 'kelas'
    ? 'Kelas Saya'
    : activeSection.value === 'tugas'
      ? 'Tugas Saya'
      : activeSection.value === 'tutor'
        ? 'Tutor Saya'
        : activeSection.value === 'cari'
          ? 'Cari Tutor'
          : 'Beranda Siswa',
)

const kelasFilter = ref('semua')
const kelasView = ref('list')
const kelasMateriTab = ref('materi')
const selectedKelas = ref(null)
const selectedLesson = ref(null)
const showCreateMaterialForm = ref(false)
const isCreatingMaterial = ref(false)
const createMaterialError = ref('')
const createMaterialSuccess = ref('')
const newMaterialForm = ref({
  title: '',
  description: '',
  status: 'locked',
})

const tutorFilter = ref('menunggu')
const tutorTabs = [
  { id: 'terkonfirmasi', label: 'Terkonfirmasi' },
  { id: 'menunggu', label: 'Menunggu' },
]
const tutorSayaItems = [
  {
    id: 1,
    name: 'Isyana Randini',
    avatar: '👩🏻',
    location: 'Denpasar Selatan',
    method: 'Metode: Privat ke rumah',
    status: 'pending',
  },
  {
    id: 2,
    name: 'Renata Salsabila',
    avatar: '👩🏽',
    location: 'Denpasar Timur',
    method: 'Metode: Online & privat',
    status: 'confirmed',
  },
  {
    id: 3,
    name: 'Aldora Pratama',
    avatar: '👨🏻',
    location: 'Badung Utara',
    method: 'Metode: Privat ke rumah',
    status: 'confirmed',
  },
]

const filteredTutorSaya = computed(() => {
  if (tutorFilter.value === 'menunggu') {
    return tutorSayaItems.filter((item) => item.status === 'pending')
  }
  return tutorSayaItems.filter((item) => item.status === 'confirmed')
})

const cariTutorQuery = ref('')
const cariTutorFilter = ref('Semua')
const cariView = ref('semua')
const cariTutorCategories = ['Semua', 'Fisika', 'Matematika', 'Bahasa Inggris', 'Informatika']

const cariTutorItems = [
  { id: 1, name: 'Isyana Randini', avatar: '👩🏻', subject: 'Matematika', target: 'Tutor SD - SMA', rating: 4.7, distance: 1.2, description: 'Tutor matematika berpengalaman mengajar aljabar, geometri, dan trigonometri. Sabar dan membuat belajar jadi menyenangkan!' },
  { id: 2, name: 'James Nathan', avatar: '👨🏼', subject: 'Matematika', target: 'Tutor SD - SMA', rating: 4.7, distance: 2.5, description: 'Tutor matematika berpengalaman mengajar aljabar, geometri, dan trigonometri. Sabar dan membuat belajar jadi menyenangkan!' },
  { id: 3, name: 'John Doe', avatar: '👨🏻', subject: 'Matematika', target: 'Tutor SD - SMA', rating: 4.7, distance: 3.1, description: 'Tutor matematika berpengalaman mengajar aljabar, geometri, dan trigonometri. Sabar dan membuat belajar jadi menyenangkan!' },
  { id: 4, name: 'Ananta Aldora', avatar: '👨🏽', subject: 'Matematika', target: 'Tutor SD - SMA', rating: 4.7, distance: 4.0, description: 'Tutor matematika berpengalaman mengajar aljabar, geometri, dan trigonometri. Sabar dan membuat belajar jadi menyenangkan!' },
  { id: 5, name: 'Isyana Randini', avatar: '👩🏻', subject: 'Matematika', target: 'Tutor SD - SMA', rating: 4.7, distance: 5.2, description: 'Tutor matematika berpengalaman mengajar aljabar, geometri, dan trigonometri. Sabar dan membuat belajar jadi menyenangkan!' },
  { id: 6, name: 'James Nathan', avatar: '👨🏼', subject: 'Matematika', target: 'Tutor SD - SMA', rating: 4.7, distance: 6.8, description: 'Tutor matematika berpengalaman mengajar aljabar, geometri, dan trigonometri. Sabar dan membuat belajar jadi menyenangkan!' },
  { id: 7, name: 'Isyana Randini', avatar: '👩🏻', subject: 'Matematika', target: 'Tutor SD - SMA', rating: 4.7, distance: 8.5, description: 'Tutor matematika berpengalaman mengajar aljabar, geometri, dan trigonometri. Sabar dan membuat belajar jadi menyenangkan!' },
  { id: 8, name: 'John Doe', avatar: '👨🏻', subject: 'Matematika', target: 'Tutor SD - SMA', rating: 4.7, distance: 10.1, description: 'Tutor matematika berpengalaman mengajar aljabar, geometri, dan trigonometri. Sabar dan membuat belajar jadi menyenangkan!' },
]

const filteredCariTutor = computed(() => {
  let items = [...cariTutorItems]
  if (cariTutorFilter.value !== 'Semua') {
    items = items.filter(item => item.subject === cariTutorFilter.value)
  }
  if (cariTutorQuery.value) {
    const q = cariTutorQuery.value.toLowerCase()
    items = items.filter(item => item.name.toLowerCase().includes(q) || item.subject.toLowerCase().includes(q))
  }
  if (cariView.value === 'terdekat') {
    items.sort((a, b) => a.distance - b.distance)
  }
  return items
})

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

const tugasSayaItems = [
  { id: 1, title: 'Latihan Transformasi Geometri', subject: 'Matematika', tutor: 'Nadriin', schedule: 'Jumat, 17 Mei', icon: '🧪', statusType: 'pending', statusLabel: 'Belum Selesai', meta: 'Batas Waktu: 21 Mei 2025, 14.00', primaryAction: 'Kumpulkan', secondaryAction: 'Lihat Tugas', detailDescription: 'Selesaikan latihan transformasi geometri sesuai instruksi pada lembar tugas.', detailRules: ['Kerjakan secara mandiri', 'Unggah jawaban sebelum batas waktu', 'Pastikan foto jawaban jelas'], quizTotalSoal: 10, quizDurasi: '10 menit', quizSkorMinimal: '70/100', submittedAt: null, answerContent: '' },
  { id: 2, title: 'Menulis Huruf Hiragana', subject: 'Bahasa Jepang', tutor: 'Renata', schedule: 'Senin, 11 Mei', icon: '🇯🇵', statusType: 'pending', statusLabel: 'Belum Selesai', meta: 'Batas Waktu: 21 Mei 2025, 23.00', primaryAction: 'Kumpulkan', secondaryAction: 'Lihat Tugas', detailDescription: 'Tuliskan huruf hiragana sesuai urutan yang telah dipelajari.', detailRules: ['Tulis di buku tulis', 'Foto hasil tulisan dengan jelas', 'Kirim sebelum batas waktu'], quizTotalSoal: 10, quizDurasi: '10 menit', quizSkorMinimal: '70/100', submittedAt: null, answerContent: '' },
  { id: 3, title: 'Membuat Catatan Reaksi Kimia', subject: 'Kimia', tutor: 'Jack', schedule: 'Minggu, 10 Mei', icon: '⚗️', statusType: 'pending', statusLabel: 'Belum Selesai', meta: 'Batas Waktu: 23 Mei 2025, 19.00', primaryAction: 'Kumpulkan', secondaryAction: 'Lihat Tugas', detailDescription: 'Buat rangkuman reaksi kimia dari materi minggu ini.', detailRules: ['Minimal 1 halaman', 'Tuliskan 5 contoh reaksi', 'Sertakan kesimpulan'], quizTotalSoal: 10, quizDurasi: '10 menit', quizSkorMinimal: '70/100', submittedAt: null, answerContent: '' },
  { id: 4, title: 'Melengkapi Soal Grammar', subject: 'Bahasa Inggris', tutor: 'John Doe', schedule: 'Jumat, 17 Mei', icon: '🧩', statusType: 'done', statusLabel: 'Sudah Dikumpulkan', meta: 'Sudah Dikumpulkan', primaryAction: 'Lihat Jawaban', secondaryAction: 'Detail', detailDescription: 'Tugas grammar telah selesai dikerjakan.', detailRules: ['Review jawaban untuk evaluasi'], quizTotalSoal: 10, quizDurasi: '10 menit', quizSkorMinimal: '70/100', submittedAt: '17 Mei 2026, 19:42', answerContent: 'Saya melengkapi seluruh soal grammar dengan fokus pada present tense dan subject-verb agreement.' },
  { id: 5, title: 'Mendesain UI Sederhana', subject: 'Informatika', tutor: 'Nadriin', schedule: 'Senin, 11 Mei', icon: '🎨', statusType: 'done', statusLabel: 'Sudah Dikumpulkan', meta: 'Sudah Dikumpulkan', primaryAction: 'Lihat Jawaban', secondaryAction: 'Detail', detailDescription: 'Tugas desain UI telah dikumpulkan.', detailRules: ['Periksa feedback tutor'], quizTotalSoal: 10, quizDurasi: '10 menit', quizSkorMinimal: '70/100', submittedAt: '15 Mei 2026, 20:11', answerContent: 'Saya membuat wireframe dashboard dengan 3 section utama: ringkasan, tugas aktif, dan progres belajar.' },
  { id: 6, title: 'Membuat Ringkasan Artikel', subject: 'Bahasa Indonesia', tutor: 'Jonathan', schedule: 'Minggu, 10 Mei', icon: '📝', statusType: 'done', statusLabel: 'Sudah Dikumpulkan', meta: 'Sudah Dikumpulkan', primaryAction: 'Lihat Jawaban', secondaryAction: 'Detail', detailDescription: 'Ringkasan artikel sudah dikumpulkan.', detailRules: ['Cek komentar tutor di hasil tugas'], quizTotalSoal: 10, quizDurasi: '10 menit', quizSkorMinimal: '70/100', submittedAt: '14 Mei 2026, 16:03', answerContent: 'Ringkasan artikel saya mencakup gagasan utama, poin pendukung, dan simpulan akhir.' },
  { id: 7, title: 'Mindmap Sistem Pernapasan', subject: 'Biologi', tutor: 'Aldora', schedule: 'Senin, 11 Mei', icon: '🫁', statusType: 'done', statusLabel: 'Sudah Dikumpulkan', meta: 'Sudah Dikumpulkan', primaryAction: 'Lihat Jawaban', secondaryAction: 'Detail', detailDescription: 'Mindmap sistem pernapasan sudah terkumpul.', detailRules: ['Lihat evaluasi dan revisi jika diperlukan'], quizTotalSoal: 10, quizDurasi: '10 menit', quizSkorMinimal: '70/100', submittedAt: '13 Mei 2026, 10:27', answerContent: 'Saya membuat mindmap dari hidung, trakea, bronkus, hingga alveolus beserta fungsi tiap bagian.' },
  { id: 8, title: 'Kuis Hiragana Dasar', subject: 'Bahasa Jepang', tutor: 'Renata', schedule: 'Senin, 11 Mei', icon: '📋', statusType: 'pending', statusLabel: 'Belum Selesai', meta: 'Durasi: 10 Menit • 10 Soal', primaryAction: 'Mulai Kuis', secondaryAction: 'Lihat Tugas', detailDescription: 'Kamu akan mengerjakan kuis menulis huruf hiragana dasar dalam Bahasa Jepang. Jawablah semua pertanyaan-pertanyaan yang telah ditentukan.', detailRules: ['Quiz terdiri dari 10 soal pilihan ganda', 'Waktu pengerjaan 10 menit', 'Setiap soal hanya memiliki 1 jawaban benar', 'Tidak dapat kembali ke soal sebelumnya (optional)', 'Quiz akan otomatis selesai saat waktu habis', 'Pastikan koneksi internet stabil saat mengerjakan'], quizTotalSoal: 10, quizDurasi: '10 menit', quizSkorMinimal: '70/100', submittedAt: null, answerContent: '' },
]

const komentarTugas = ref({
  4: [{ id: 1, author: 'Tutor John Doe', time: '17 Mei 2026, 20:01', message: 'Bagus, grammar kamu sudah rapi. Tetap latihan ya.' }],
  5: [{ id: 1, author: 'Tutor Nadriin', time: '15 Mei 2026, 21:10', message: 'UI kamu clean, tinggal perbaiki spacing pada card kedua.' }],
})

const tugasBelumSelesaiCount = computed(
  () => tugasSayaItems.filter((task) => task.statusType === 'pending').length,
)

const filteredTugasSaya = computed(() => {
  if (tugasFilter.value === 'belum') {
    return tugasSayaItems.filter((task) => task.statusType === 'pending')
  }
  if (tugasFilter.value === 'selesai') {
    return tugasSayaItems.filter((task) => task.statusType === 'done')
  }
  return tugasSayaItems
})

const quizQuestions = ref([
  {
    id: 1,
    question: 'Huruf hiragana untuk bunyi "a" adalah...',
    options: [
      { value: 'a', label: 'あ' },
      { value: 'b', label: 'い' },
      { value: 'c', label: 'う' },
      { value: 'd', label: 'え' },
    ],
  },
  {
    id: 2,
    question: 'Huruf hiragana untuk bunyi "i" adalah...',
    options: [
      { value: 'a', label: 'あ' },
      { value: 'b', label: 'い' },
      { value: 'c', label: 'お' },
      { value: 'd', label: 'う' },
    ],
  },
  {
    id: 3,
    question: 'Huruf hiragana untuk bunyi "o" adalah...',
    options: [
      { value: 'a', label: 'え' },
      { value: 'b', label: 'あ' },
      { value: 'c', label: 'お' },
      { value: 'd', label: 'い' },
    ],
  },
])

const currentQuestion = computed(() => quizQuestions.value[quizIndex.value] ?? null)
const currentQuestionNumber = computed(() => quizIndex.value + 1)
const currentAnswer = computed(() => quizAnswers.value[currentQuestion.value?.id] ?? null)
const quizProgress = computed(() => ((quizIndex.value + 1) / quizQuestions.value.length) * 100)
const formattedQuizTime = computed(() => {
  const minutes = String(Math.floor(quizRemainingSeconds.value / 60)).padStart(2, '0')
  const seconds = String(quizRemainingSeconds.value % 60).padStart(2, '0')
  return `${minutes}:${seconds}`
})

const selectedTugasComments = computed(() => {
  if (!selectedTugas.value?.id) return []
  return komentarTugas.value[selectedTugas.value.id] ?? []
})

function openTugasDetail(task) {
  selectedTugas.value = task
  newKomentar.value = ''
  stopQuizTimer()
  tugasView.value = 'detail'
}

function handleTaskAction(task, actionType) {
  const actionText = actionType === 'primary' ? task.primaryAction : task.secondaryAction
  if (String(actionText).toLowerCase().includes('jawaban')) {
    openJawabanTugas(task)
    return
  }
  openTugasDetail(task)
}

function goBackToTugasList() {
  stopQuizTimer()
  tugasView.value = 'list'
}

function openJawabanTugas(task) {
  selectedTugas.value = task
  newKomentar.value = ''
  stopQuizTimer()
  tugasView.value = 'answer'
}

function submitKomentar() {
  if (!selectedTugas.value?.id || !newKomentar.value.trim()) return
  const current = komentarTugas.value[selectedTugas.value.id] ?? []
  komentarTugas.value = {
    ...komentarTugas.value,
    [selectedTugas.value.id]: [
      ...current,
      {
        id: Date.now(),
        author: 'Kenzo Aliza',
        time: new Date().toLocaleString('id-ID'),
        message: newKomentar.value.trim(),
      },
    ],
  }
  newKomentar.value = ''
}

function downloadJawaban() {
  if (!selectedTugas.value) return
  const content = [
    `Judul Tugas: ${selectedTugas.value.title}`,
    `Mapel: ${selectedTugas.value.subject}`,
    `Tutor: ${selectedTugas.value.tutor}`,
    `Waktu Dikumpulkan: ${selectedTugas.value.submittedAt || '-'}`,
    '',
    'Jawaban:',
    selectedTugas.value.answerContent || '-',
  ].join('\n')

  const blob = new Blob([content], { type: 'text/plain;charset=utf-8' })
  const url = URL.createObjectURL(blob)
  const link = document.createElement('a')
  link.href = url
  link.download = `jawaban-${String(selectedTugas.value.title).toLowerCase().replace(/\s+/g, '-')}.txt`
  document.body.appendChild(link)
  link.click()
  document.body.removeChild(link)
  URL.revokeObjectURL(url)
}

function selectAnswer(value) {
  if (!currentQuestion.value) return
  quizAnswers.value = {
    ...quizAnswers.value,
    [currentQuestion.value.id]: value,
  }
}

function goNextQuestion() {
  if (quizIndex.value < quizQuestions.value.length - 1) {
    quizIndex.value += 1
  }
}

function goPrevQuestion() {
  if (quizIndex.value > 0) {
    quizIndex.value -= 1
  }
}

function stopQuizTimer() {
  if (quizTimerId) {
    clearInterval(quizTimerId)
    quizTimerId = null
  }
}

function submitQuiz() {
  stopQuizTimer()
  quizSubmitted.value = true
  tugasView.value = 'list'
}

function startQuizFromTask() {
  if (!selectedTugas.value) return
  if (!String(selectedTugas.value.primaryAction).toLowerCase().includes('kuis')) return

  quizIndex.value = 0
  quizAnswers.value = {}
  quizSubmitted.value = false
  quizRemainingSeconds.value = 10 * 60
  tugasView.value = 'quiz'

  stopQuizTimer()
  quizTimerId = setInterval(() => {
    if (quizRemainingSeconds.value <= 1) {
      quizRemainingSeconds.value = 0
      submitQuiz()
      return
    }
    quizRemainingSeconds.value -= 1
  }, 1000)
}

onBeforeUnmount(() => {
  stopQuizTimer()
})

const kelasTabs = [
  { id: 'semua', label: 'Semua' },
  { id: 'aktif', label: 'Aktif' },
  { id: 'selesai', label: 'Selesai' },
]

const kelasItems = [
  {
    id: 1,
    subject: 'Informatika',
    topic: 'UI/UX Design',
    tutor: 'Ananta Aldora',
    schedule: 'Jumat, 15:00-17:30',
    status: 'upcoming',
    icon: '🖥️',
    progress: 0,
  },
  {
    id: 2,
    subject: 'Fisika',
    topic: 'Listrik dan Magnet',
    tutor: 'Yura Agustina',
    schedule: 'Rabu, 12:00-13:30',
    status: 'upcoming',
    icon: '🧲',
    progress: 0,
  },
  {
    id: 3,
    subject: 'Matematika',
    topic: 'Transformasi Geometri',
    tutor: 'Isyana Randini',
    schedule: 'Jumat, 15:00-17:30',
    status: 'active',
    icon: '📐',
    progress: 15,
  },
  {
    id: 4,
    subject: 'Bahasa Jepang',
    topic: 'Huruf Hiragana',
    tutor: 'Renata',
    schedule: 'Rabu, 12:00-13:30',
    status: 'active',
    icon: '🇯🇵',
    progress: 65,
  },
  {
    id: 13,
    subject: 'Bahasa Inggris',
    topic: 'Simple Present Tense',
    tutor: 'John Doe',
    schedule: 'Jumat, 17:00-18:30',
    status: 'active',
    icon: '🇬🇧',
    progress: 40,
  },
  {
    id: 14,
    subject: 'Bahasa Indonesia',
    topic: 'Paragraf Deduktif',
    tutor: 'Jonathan',
    schedule: 'Sabtu, 15:00-17:30',
    status: 'active',
    icon: '📚',
    progress: 95,
  },
  { id: 5, subject: 'Biologi', topic: 'Asam Nukleat', tutor: 'Oliver James', schedule: 'Senin, 10:00-11:30', status: 'completed', icon: '🧬', progress: 100 },
  { id: 6, subject: 'Kimia', topic: 'Reaksi Kimia', tutor: 'Oliver James', schedule: 'Selasa, 13:00-14:30', status: 'completed', icon: '🧪', progress: 100 },
  { id: 7, subject: 'Sejarah', topic: 'Sejarah Dunia Modern', tutor: 'Maria Santoso', schedule: 'Rabu, 09:00-10:30', status: 'completed', icon: '🌍', progress: 100 },
  { id: 8, subject: 'Matematika', topic: 'Bangun Ruang', tutor: 'Isyana Randini', schedule: 'Kamis, 15:00-16:30', status: 'completed', icon: '📦', progress: 100 },
  { id: 9, subject: 'Matematika', topic: 'Phytagoras', tutor: 'Budi Wijaya', schedule: 'Jumat, 08:00-09:30', status: 'completed', icon: '📏', progress: 100 },
  { id: 10, subject: 'Geografi', topic: 'Peta dan Pemetaan', tutor: 'Dewi Lestari', schedule: 'Sabtu, 10:00-11:30', status: 'completed', icon: '🗺️', progress: 100 },
  { id: 11, subject: 'Seni Budaya', topic: 'Seni Musik', tutor: 'Rina Kusuma', schedule: 'Minggu, 14:00-15:30', status: 'completed', icon: '🎵', progress: 100 },
  { id: 12, subject: 'Ekonomi', topic: 'Manajemen Keuangan', tutor: 'Andre Pratama', schedule: 'Senin, 15:00-16:30', status: 'completed', icon: '💹', progress: 100 },
]

const jumlahKelasAktifMingguIni = computed(
  () => kelasItems.filter((k) => k.status === 'active').length,
)

const filteredKelas = computed(() => {
  if (kelasFilter.value === 'aktif') {
    return kelasItems.filter((k) => k.status === 'active')
  }
  if (kelasFilter.value === 'selesai') {
    return kelasItems.filter((k) => k.status === 'completed')
  }
  return kelasItems
})

const fallbackJapaneseMaterials = [
  {
    id: 1,
    order: 1,
    title: 'Dasar Hiragana',
    description: 'Belajar dasar pengenalan huruf hiragana.',
    status: 'completed',
    isCurrent: true,
  },
  {
    id: 2,
    order: 2,
    title: 'Huruf Baris K',
    description: 'Belajar dasar pengenalan huruf hiragana.',
    status: 'locked',
    isCurrent: false,
  },
  {
    id: 3,
    order: 3,
    title: 'Huruf Baris S',
    description: 'Belajar dasar pengenalan huruf hiragana.',
    status: 'locked',
    isCurrent: false,
  },
  {
    id: 4,
    order: 4,
    title: 'Huruf Baris T',
    description: 'Belajar dasar pengenalan huruf hiragana.',
    status: 'locked',
    isCurrent: false,
  },
]

const fallbackJapaneseTasks = [
  {
    id: 1,
    order: 1,
    title: 'Tugas 1: Menulis Hiragana A-Ka',
    description: 'Tulislah di buku tulis, hiragana A-Ka',
    deadline: 'Ming, 20.00',
    statusType: 'done',
    statusLabel: '✔ Sudah Dikumpul',
    action: 'Lihat Jawaban',
  },
  {
    id: 2,
    order: 2,
    title: 'Tugas 2: Menulis Hiragana A-Sa',
    description: 'Tulislah di buku tulis, hiragana A-Ka',
    deadline: 'Ming, 20.00',
    statusType: 'pending',
    statusLabel: '◷ Belum Dikerjakan',
    action: 'Kerjakan',
  },
  {
    id: 3,
    order: 3,
    title: 'Tugas 3: Menulis Hiragana A-Sa',
    description: 'Tulislah di buku tulis, hiragana A-Ka',
    deadline: 'Ming, 20.00',
    statusType: 'late',
    statusLabel: '◉ Terlambat',
    action: '',
  },
]

const japaneseMaterials = computed(() => {
  const source = japaneseClassState.value?.materials ?? []
  if (!source.length) {
    return fallbackJapaneseMaterials
  }

  return source.map((material, index) => ({
    id: material.id,
    order: material.order_index ?? index + 1,
    title: material.title,
    description: material.description || 'Belajar materi bahasa Jepang.',
    status: material.status || 'locked',
    isCurrent: index === 0,
  }))
})

function getTaskStatusType(status) {
  if (status === 'done') return 'done'
  if (status === 'late') return 'late'
  return 'pending'
}

function getTaskStatusLabel(statusType) {
  if (statusType === 'done') return '✔ Sudah Dikumpul'
  if (statusType === 'late') return '◉ Terlambat'
  return '◷ Belum Dikerjakan'
}

function getTaskAction(statusType) {
  if (statusType === 'done') return 'Lihat Jawaban'
  if (statusType === 'pending') return 'Kerjakan'
  return ''
}

const japaneseTasks = computed(() => {
  const source = japaneseClassState.value?.materials ?? []
  if (!source.length) {
    return fallbackJapaneseTasks
  }

  return source.flatMap((material) =>
    (material.tasks ?? []).map((task, index) => {
      const statusType = getTaskStatusType(task.status)
      return {
        id: task.id,
        order: index + 1,
        title: task.title,
        description: task.description || `Tugas untuk materi ${material.title}`,
        deadline: task.deadline ? new Date(task.deadline).toLocaleString('id-ID') : '-',
        statusType,
        statusLabel: getTaskStatusLabel(statusType),
        action: getTaskAction(statusType),
      }
    }),
  )
})

const canCreateMaterial = computed(() => Boolean(japaneseClassState.value?.id))

function resetCreateMaterialForm() {
  newMaterialForm.value = {
    title: '',
    description: '',
    status: 'locked',
  }
}

async function submitCreateMaterial() {
  createMaterialError.value = ''
  createMaterialSuccess.value = ''

  if (!newMaterialForm.value.title.trim()) {
    createMaterialError.value = 'Judul materi wajib diisi.'
    return
  }

  if (!japaneseClassState.value?.id) {
    createMaterialError.value = 'Kelas Bahasa Jepang belum tersedia di database.'
    return
  }

  isCreatingMaterial.value = true

  try {
    const response = await window.axios.post(
      `/study-classes/${japaneseClassState.value.id}/materials`,
      {
        title: newMaterialForm.value.title,
        description: newMaterialForm.value.description,
        status: newMaterialForm.value.status,
      },
    )

    const createdMaterial = response?.data?.data
    if (createdMaterial) {
      const currentMaterials = japaneseClassState.value.materials ?? []
      japaneseClassState.value = {
        ...japaneseClassState.value,
        materials: [...currentMaterials, createdMaterial],
      }
      createMaterialSuccess.value = 'Materi berhasil ditambahkan beserta tugas default.'
      resetCreateMaterialForm()
    }
  } catch (error) {
    createMaterialError.value = error?.response?.data?.message ?? 'Gagal menambahkan materi.'
  } finally {
    isCreatingMaterial.value = false
  }
}

const hiraganaTable = [
  { upper: 'A', char: 'あ', romaji: 'a' },
  { upper: 'I', char: 'い', romaji: 'i' },
  { upper: 'U', char: 'う', romaji: 'u' },
  { upper: 'E', char: 'え', romaji: 'e' },
  { upper: 'O', char: 'お', romaji: 'o' },
]

const learningTips = [
  { id: 1, title: 'Ulangi dan Tulis', description: 'Tulis tiap huruf hingga terbiasa dengan bentuknya dan cara pengucapannya.' },
  { id: 2, title: 'Gunakan Kartu', description: 'Buat kartu huruf dan bacakan dengan suara nyaring untuk memperkuat ingatan.' },
  { id: 3, title: 'Bermain Quiz', description: 'Latih diri dengan kuis ringan agar hafalan lebih cepat dan menyenangkan.' },
]

function openKelasMateri(kelas) {
  selectedKelas.value = kelas
  selectedLesson.value = japaneseMaterials.value[0] ?? null
  kelasMateriTab.value = 'materi'
  kelasView.value = 'materi'
}

function openMateriDetail(materi) {
  selectedLesson.value = materi
  kelasView.value = 'detail'
}

function goBackToKelasList() {
  kelasView.value = 'list'
}

function goBackToMateriList() {
  kelasView.value = 'materi'
}

const progres = [
  { id: 1, subject: 'Matematika', topic: 'Aljabar & Fungsi', tutor: 'Isyana Randini', schedule: 'Senin, 15:00', percent: 15 },
  { id: 2, subject: 'Bahasa Jepang', topic: 'Hiragana & Katakana', tutor: 'Yuki Tanaka', schedule: 'Rabu, 10:00', percent: 85 },
  { id: 3, subject: 'Bahasa Inggris', topic: 'Grammar & Speaking', tutor: 'Isyana Randini', schedule: 'Jumat, 16:00', percent: 40 },
  { id: 4, subject: 'Bahasa Indonesia', topic: 'Teks Eksposisi', tutor: 'John Doe', schedule: 'Kamis, 14:00', percent: 95 },
];

const jadwal = [
  { id: 1, subject: 'Matematika', tutor: 'Isyana Randini', time: 'Hari ini, 15:00 - 17:30', img: '👩🏼‍💼' },
  { id: 2, subject: 'Bahasa Indonesia', tutor: 'John Doe', time: 'Jumat, 19:00 - 20:30', img: '👨🏻‍💼' },
  { id: 3, subject: 'Bahasa Inggris', tutor: 'Isyana Randini', time: 'Minggu, 15:00 - 17:30', img: '👩🏼‍💼' },
];

const tugas = [
  { id: 1, subject: 'Matematika', icon: '📐', desc: 'Transformasi Geometri', posted: '24 Menit Lalu' },
  { id: 2, subject: 'Bahasa Indonesia', icon: '📖', desc: 'Paragraf Deduktif', posted: '1 Jam Lalu' },
  { id: 3, subject: 'Bahasa Jepang', icon: '🇯🇵', desc: 'Huruf Hiragana', posted: '22 Jam Lalu' },
];
</script>
