<template>
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
                    <img :src="`https://ui-avatars.com/api/?name=${tutor.name.replace(/ /g, '+')}&background=eff6ff&color=2563eb`" alt="Avatar" class="w-full h-full object-cover" />
                  </div>
                  <div>
                    <h3 class="text-lg font-black text-[#2563EB] leading-tight">{{ tutor.name }}</h3>
                    <p class="text-xs font-bold text-gray-500 mt-0.5">{{ tutor.subjects.map(s => s.name).join(', ') }}</p>
                    <p class="text-[11px] text-gray-400 mt-1 font-semibold flex items-center gap-1">🎓 Tutor Ahli</p>
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
                    @click="viewTutor(tutor)"
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
              <div class="animate-fade-in" v-if="selectedTutor">
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
                        <img :src="`https://ui-avatars.com/api/?name=${selectedTutor.name.replace(/ /g, '+')}&background=eff6ff&color=2563eb&size=256`" :alt="selectedTutor.name" class="w-full h-full object-cover">
                      </div>
                      <div class="pt-2">
                        <h2 class="text-3xl font-black text-gray-900 mb-2">{{ selectedTutor.name }}</h2>
                        <div class="flex items-center gap-1 mb-3">
                          <span class="text-amber-400 text-lg">⭐⭐⭐⭐⭐</span>
                        </div>
                        <div class="space-y-2">
                          <p class="flex items-center gap-2 text-sm font-bold text-gray-500">
                            <span class="w-5 text-center text-lg">📚</span> {{ selectedTutor.subjects.map(s => s.name).join(', ') }}
                          </p>
                          <p class="flex items-center gap-2 text-sm font-bold text-gray-500">
                            <span class="w-5 text-center text-lg">📍</span> Tersedia Area Lokal / Online
                          </p>
                        </div>
                      </div>
                    </div>

                    <!-- Description Box -->
                    <div class="mt-8 bg-[#F5F7FF] rounded-2xl p-5">
                      <p class="text-sm text-gray-600 leading-relaxed font-medium">
                        {{ selectedTutor.description }}
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
                            <span class="text-gray-400">🎓</span> Semua Jenjang
                          </p>
                          <p v-for="sub in selectedTutor.subjects" :key="sub.id" class="flex items-center gap-2 text-sm font-bold text-gray-500">
                            <span class="text-gray-400">{{ sub.icon || '📚' }}</span> {{ sub.name }}
                          </p>
                        </div>
                      </div>
                    </div>
                  </div>

                  <!-- Right Column: Pricing -->
                  <div class="lg:col-span-1 space-y-6">
                    <!-- Pricing Card -->
                    <div class="bg-white rounded-[24px] border border-gray-200 p-6 shadow-sm">
                      <h3 class="text-lg font-black text-gray-900 mb-4">Biaya Mengajar</h3>
                      <div class="space-y-0">
                        <div v-for="sub in selectedTutor.subjects" :key="sub.id" class="flex justify-between items-center py-4 border-b border-gray-100 last:border-0">
                          <span class="text-sm font-bold text-gray-800">{{ sub.name }}</span>
                          <div class="text-right">
                            <span class="text-[11px] font-bold text-gray-400 block mb-0.5">1 Jam</span>
                            <span class="text-sm font-black text-gray-900">Rp{{ sub.price.toLocaleString('id-ID') }}</span>
                          </div>
                        </div>
                      </div>

                      <button @click="bookTutor" type="button" class="mt-4 w-full bg-[#2563EB] text-white py-3.5 rounded-xl text-sm font-bold shadow-sm hover:bg-blue-700 transition">
                        Pesan Tutor
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
                      <button @click="cariView = 'pesan_tutor'" type="button" class="bg-[#2563EB] text-white px-6 py-3 rounded-xl font-bold text-sm shadow-sm flex items-center gap-2 hover:bg-blue-700 transition">
                        📅 Booking Sekarang
                      </button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            </template>

            <template v-else-if="cariView === 'pesan_tutor'">
              <!-- Pesan Tutor View -->
              <div class="animate-fade-in">
                <!-- Back Button -->
                <div class="mb-6">
                  <button @click="cariView = 'lokasi_detail'" type="button" class="bg-white border border-gray-200 text-gray-700 px-4 py-2 rounded-lg font-bold text-sm inline-flex items-center gap-2 hover:bg-gray-50 transition shadow-sm">
                    <span aria-hidden="true">←</span> Kembali
                  </button>
                </div>
                <h2 class="text-3xl font-black mb-6 text-gray-900">Pesan Tutor</h2>

                <div class="bg-white rounded-[24px] border border-gray-200 shadow-sm p-8">
                  <!-- Tutor Header -->
                  <div class="flex items-center gap-5 pb-6 border-b border-gray-100 mb-6">
                    <div class="w-20 h-20 rounded-full bg-blue-50 overflow-hidden shrink-0 border border-blue-100 flex items-center justify-center text-4xl">
                      <img src="https://ui-avatars.com/api/?name=Isyana+Randini&background=eff6ff&color=2563eb" alt="Isyana Randini" class="w-full h-full object-cover">
                    </div>
                    <div>
                      <h3 class="text-2xl font-black text-gray-900 leading-tight">Isyana Randini</h3>
                      <div class="flex items-center gap-1 mt-1 text-sm font-bold">
                        <span class="text-amber-400">⭐⭐⭐⭐⭐</span>
                      </div>
                      <p class="text-sm font-bold text-gray-500 mt-2 flex items-center gap-2">
                        <span class="text-gray-400 text-base w-4 text-center">📚</span> Matematika
                      </p>
                      <p class="text-sm font-bold text-gray-500 mt-1 flex items-center gap-2">
                        <span class="text-gray-400 text-base w-4 text-center">📍</span> Denpasar Selatan
                      </p>
                    </div>
                  </div>

                  <h3 class="text-[#2563EB] text-xl font-black mb-6">Pilih paket sesuai yang kamu mau.</h3>

                  <!-- 1. Metode Belajar -->
                  <div class="mb-8">
                    <h4 class="text-lg font-black text-gray-900 mb-4">1. Pilih Metode Belajar</h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                      <!-- Option 1 -->
                      <label class="relative border-2 border-gray-200 rounded-2xl p-5 cursor-pointer hover:border-blue-300 transition flex items-center gap-4 has-[:checked]:border-blue-500 has-[:checked]:bg-blue-50/50">
                        <input type="radio" name="metode_belajar" value="rumah" class="hidden" checked>
                        <div class="text-gray-400 text-2xl w-8 text-center shrink-0">🏠</div>
                        <div>
                          <p class="text-sm font-bold text-gray-800 leading-snug">Tutor datang ke rumah kamu</p>
                          <p class="text-xs font-bold text-[#2563EB] mt-1">Area: Denpasar Selatan</p>
                        </div>
                      </label>
                      <!-- Option 2 -->
                      <label class="relative border-2 border-gray-200 rounded-2xl p-5 cursor-pointer hover:border-blue-300 transition flex items-center gap-4 has-[:checked]:border-blue-500 has-[:checked]:bg-blue-50/50">
                        <input type="radio" name="metode_belajar" value="online" class="hidden">
                        <div class="text-gray-400 text-2xl w-8 text-center shrink-0">💻</div>
                        <div>
                          <p class="text-sm font-bold text-gray-800 leading-snug">Online</p>
                          <p class="text-xs font-bold text-[#2563EB] mt-1">Zoom / Google Meet</p>
                        </div>
                      </label>
                    </div>
                  </div>

                  <!-- 2. Paket Mengajar -->
                  <div class="mb-8">
                    <h4 class="text-lg font-black text-gray-900 mb-4">2. Pilih Paket Mengajar</h4>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                      <!-- Paket 1 -->
                      <label class="relative border-2 border-gray-200 rounded-2xl p-5 cursor-pointer hover:border-blue-300 transition flex flex-col has-[:checked]:border-blue-500 has-[:checked]:bg-blue-50/50">
                        <input type="radio" name="paket_mengajar" value="4x" class="hidden" checked>
                        <p class="text-sm font-bold text-gray-900 mb-2">4x Pertemuan</p>
                        <p class="text-2xl font-black text-gray-900 mb-1">Rp400.000 <span class="text-[10px] font-bold text-gray-400 uppercase">sebulan</span></p>
                        <p class="text-xs text-gray-500 font-medium">1 Minggu sekali selama 1 bulan</p>
                      </label>
                      <!-- Paket 2 -->
                      <label class="relative border-2 border-gray-200 rounded-2xl p-5 cursor-pointer hover:border-blue-300 transition flex flex-col has-[:checked]:border-blue-500 has-[:checked]:bg-blue-50/50">
                        <input type="radio" name="paket_mengajar" value="8x" class="hidden">
                        <p class="text-sm font-bold text-gray-900 mb-2">8x Pertemuan</p>
                        <p class="text-2xl font-black text-gray-900 mb-1">Rp760.000 <span class="text-[10px] font-bold text-gray-400 uppercase">sebulan</span></p>
                        <p class="text-xs text-gray-500 font-medium">2 Minggu sekali selama 1 bulan</p>
                      </label>
                      <!-- Paket 3 -->
                      <label class="relative border-2 border-gray-200 rounded-2xl p-5 cursor-pointer hover:border-blue-300 transition flex flex-col has-[:checked]:border-blue-500 has-[:checked]:bg-blue-50/50">
                        <input type="radio" name="paket_mengajar" value="12x" class="hidden">
                        <div class="absolute -top-3 -right-3 bg-[#2563EB] text-white text-[10px] font-bold px-3 py-1 rounded-full shadow-sm whitespace-nowrap">Paling Hemat</div>
                        <p class="text-sm font-bold text-gray-900 mb-2">8x Pertemuan</p>
                        <p class="text-2xl font-black text-gray-900 mb-1">Rp760.000 <span class="text-[10px] font-bold text-gray-400 uppercase">sebulan</span></p>
                        <p class="text-xs text-gray-500 font-medium">2 Minggu sekali selama 1 bulan</p>
                      </label>
                    </div>
                  </div>

                  <!-- 3. Rincian Biaya -->
                  <div>
                    <h4 class="text-lg font-black text-gray-900 mb-4">3. Rincian Biaya Mengajar</h4>
                    <div class="border border-gray-200 rounded-2xl overflow-hidden">
                      <div class="p-5 flex justify-between items-center border-b border-gray-100 bg-[#FAFBFC]">
                        <span class="text-base font-black text-gray-900">Paket 4x pertemuan</span>
                        <span class="text-base font-bold text-gray-900">Rp400.000</span>
                      </div>
                      <div class="p-5 bg-white flex flex-col gap-3">
                        <div class="flex justify-between items-center text-sm">
                          <span class="text-gray-500 font-medium">4x Pertemuan 1 jam x Rp100.000</span>
                        </div>
                      </div>
                      <div class="p-5 flex justify-between items-center border-t border-gray-100 bg-[#FAFBFC]">
                        <span class="text-sm font-bold text-gray-700">Total Estimasi</span>
                        <span class="text-xl font-black text-gray-900">Rp400.000</span>
                      </div>
                    </div>
                  </div>

                  <div class="mt-8 flex flex-col sm:flex-row justify-between items-center gap-4">
                    <p class="text-xs font-bold text-gray-500">Kamu bisa membayar setelah jadwal dikonfirmasi oleh tutor.</p>
                    <button @click="submitBooking" type="button" class="bg-[#2563EB] text-white px-8 py-3.5 rounded-xl font-bold text-sm shadow-sm hover:bg-blue-700 transition w-full sm:w-auto">
                      Kirim Permintaan
                    </button>
                  </div>
                </div>
              </div>
            </template>

            <template v-else-if="cariView === 'menunggu_konfirmasi'">
              <!-- Menunggu Konfirmasi View -->
              <div class="animate-fade-in">
                <!-- Back Button -->
                <div class="mb-6">
                  <button @click="cariView = 'pesan_tutor'" type="button" class="bg-white border border-gray-200 text-gray-700 px-4 py-2 rounded-lg font-bold text-sm inline-flex items-center gap-2 hover:bg-gray-50 transition shadow-sm">
                    <span aria-hidden="true">←</span> Kembali
                  </button>
                </div>
                
                <h2 class="text-3xl font-black mb-6 text-gray-900">Booking Saya</h2>

                <div class="bg-white rounded-[24px] border border-gray-200 shadow-sm overflow-hidden max-w-4xl">
                  <!-- Header Area -->
                  <div class="bg-[#FFF8F1] px-6 py-4 border-b border-gray-200">
                    <h3 class="font-bold text-gray-900">Menunggu Konfirmasi Tutor</h3>
                  </div>

                  <!-- Content Area -->
                  <div class="p-8">
                    <div class="flex items-start gap-6 mb-8">
                      <div class="w-28 h-28 rounded-full bg-blue-50 overflow-hidden shrink-0 border border-gray-100 flex items-center justify-center text-4xl shadow-sm">
                        <img src="https://ui-avatars.com/api/?name=Isyana+Randini&background=eff6ff&color=2563eb" alt="Isyana Randini" class="w-full h-full object-cover">
                      </div>
                      <div class="pt-2">
                        <h3 class="text-2xl font-black text-gray-900 leading-tight">Isyana Randini</h3>
                        <div class="flex items-center gap-1 mt-1 text-sm font-bold">
                          <span class="text-amber-400">⭐⭐⭐⭐⭐</span>
                        </div>
                        <p class="text-sm font-bold text-gray-500 mt-3 flex items-center gap-2">
                          <span class="text-gray-400 text-base w-5 text-center">📍</span> Denpasar Selatan
                        </p>
                        <p class="text-sm font-bold text-gray-500 mt-2 flex items-center gap-2">
                          <span class="text-gray-400 text-base w-5 text-center">📦</span> Paket: 4x Pertemuan
                        </p>
                        <p class="text-sm font-bold text-gray-500 mt-2 flex items-center gap-2">
                          <span class="text-gray-400 text-base w-5 text-center">🏠</span> Metode: Privat ke rumah
                        </p>
                      </div>
                    </div>

                    <!-- Status Box -->
                    <div class="bg-[#FFF8F1] border border-orange-100 rounded-xl p-4 flex items-center gap-3 mb-6">
                      <span class="text-orange-400 text-xl font-black">🕒</span>
                      <p class="text-sm font-bold text-orange-400">Status: Menunggu Konfirmasi</p>
                    </div>

                    <!-- Buttons -->
                    <div class="flex flex-col sm:flex-row gap-4 mb-4">
                      <button @click="goNav('pesan')" type="button" class="flex-1 py-3.5 rounded-xl text-sm font-bold border-2 border-[#2563EB] text-[#2563EB] hover:bg-blue-50 transition text-center shadow-sm">
                        Chat Tutor
                      </button>
                      <button type="button" class="flex-1 py-3.5 rounded-xl text-sm font-bold border-2 border-red-500 text-red-500 hover:bg-red-50 transition text-center shadow-sm">
                        Batalkan Permintaan
                      </button>
                    </div>

                    <p @click="cariView = 'booking_dikonfirmasi'" class="text-xs font-bold text-gray-400 mt-6 cursor-pointer hover:text-[#2563EB] transition">Tunggu konfirmasi dalam waktu 24 jam dari tutor (Klik teks ini untuk simulasi diterima)</p>
                  </div>
                </div>
              </div>
            </template>

            <template v-else-if="cariView === 'booking_dikonfirmasi'">
              <!-- Booking Dikonfirmasi View -->
              <div class="animate-fade-in">
                <!-- Back Button -->
                <div class="mb-6">
                  <button @click="cariView = 'menunggu_konfirmasi'" type="button" class="bg-white border border-gray-200 text-gray-700 px-4 py-2 rounded-lg font-bold text-sm inline-flex items-center gap-2 hover:bg-gray-50 transition shadow-sm">
                    <span aria-hidden="true">←</span> Kembali
                  </button>
                </div>
                
                <h2 class="text-3xl font-black mb-6 text-gray-900">Booking Saya</h2>

                <div class="bg-white rounded-[24px] border border-gray-200 shadow-sm overflow-hidden max-w-4xl">
                  <!-- Header Area -->
                  <div class="bg-[#E7FFE7] px-8 py-5 border-b border-gray-200 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                    <div>
                      <h3 class="text-2xl font-black text-gray-900">Booking Dikonfirmasi</h3>
                      <p class="text-sm font-medium text-gray-700 mt-1">Mulai les pada Senin, 16 Mei 2026</p>
                    </div>
                    <button @click="showPaymentModal = true" class="bg-[#2563EB] text-white px-6 py-3 rounded-xl font-bold text-sm shadow-sm flex items-center justify-center gap-2 hover:bg-blue-700 transition w-full sm:w-auto relative">
                      <span>💳</span> Bayar Sekarang
                    </button>
                  </div>

                  <!-- Content Area -->
                  <div class="p-8">
                    <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-6">
                      <div class="flex flex-col sm:flex-row items-start gap-6">
                        <div class="w-28 h-28 rounded-full bg-blue-50 overflow-hidden shrink-0 border border-gray-100 flex items-center justify-center text-4xl shadow-sm">
                          <img src="https://ui-avatars.com/api/?name=Isyana+Randini&background=eff6ff&color=2563eb" alt="Isyana Randini" class="w-full h-full object-cover">
                        </div>
                        <div class="pt-2">
                          <h3 class="text-2xl font-black text-gray-900 leading-tight">Isyana Randini</h3>
                          <p class="text-sm font-bold text-gray-500 mt-3 flex items-center gap-2">
                            <span class="text-gray-400 text-base w-5 text-center">📦</span> Paket: 4x Pertemuan
                          </p>
                          <p class="text-sm font-bold text-gray-500 mt-2 flex items-center gap-2">
                            <span class="text-gray-400 text-base w-5 text-center">🏠</span> Metode: Privat ke rumah
                          </p>
                          
                          <div class="mt-5 inline-flex items-center gap-2 bg-[#009966] text-white px-4 py-2.5 rounded-xl text-sm font-bold shadow-sm">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                            Telah Diterima
                          </div>
                        </div>
                      </div>
                      
                      <button @click="goNav('pesan')" type="button" class="w-full sm:w-auto px-10 py-3.5 rounded-xl text-sm font-bold border-2 border-transparent bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white hover:shadow-lg hover:shadow-blue-500/30 active:scale-95 transition-all text-center focus:outline-none focus:ring-2 focus:ring-blue-100">
                        Chat Tutor
                      </button>
                    </div>
                  </div>
                </div>

                <!-- Payment Modal Overlay -->
                <div v-if="showPaymentModal" class="fixed inset-0 z-[100] bg-gray-900/40 backdrop-blur-sm flex items-center justify-center p-4 animate-fade-in" @click.self="showPaymentModal = false">
                  <div class="bg-white rounded-3xl w-full max-w-md p-8 shadow-2xl border border-gray-100 transform transition-all">
                    <!-- Header Modal -->
                    <div class="flex justify-between items-start mb-6">
                      <div>
                        <h3 class="text-xl font-bold text-gray-900">Total Pembayaran</h3>
                        <p class="text-2xl font-black text-[#2563EB] mt-1">Rp400.000</p>
                      </div>
                      <button @click="showPaymentModal = false" class="text-gray-400 hover:text-gray-600 bg-gray-50 hover:bg-gray-100 rounded-full p-2 transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                      </button>
                    </div>

                    <p class="text-sm font-bold text-gray-700 mb-4">Pilih metode pembayaran:</p>

                    <!-- Payment Options -->
                    <div class="flex flex-col gap-3 mb-8">
                      <!-- QRIS -->
                      <label class="flex items-center gap-4 p-4 rounded-xl border-2 cursor-pointer transition-all has-[:checked]:border-[#2563EB] has-[:checked]:bg-blue-50 border-gray-200 hover:border-blue-300">
                        <input type="radio" v-model="selectedPaymentMethod" value="qris" class="hidden">
                        <div class="w-10 h-10 rounded-lg bg-blue-100 flex items-center justify-center shrink-0">
                          <span class="text-xl text-[#2563EB]">📱</span>
                        </div>
                        <div>
                          <p class="font-bold text-gray-900">QRIS</p>
                          <p class="text-xs font-bold text-gray-500">Pembayaran QR Code</p>
                        </div>
                      </label>

                      <!-- E-Wallet -->
                      <label class="flex items-center gap-4 p-4 rounded-xl border-2 cursor-pointer transition-all has-[:checked]:border-[#2563EB] has-[:checked]:bg-blue-50 border-gray-200 hover:border-blue-300">
                        <input type="radio" v-model="selectedPaymentMethod" value="ewallet" class="hidden">
                        <div class="w-10 h-10 rounded-lg bg-blue-100 flex items-center justify-center shrink-0">
                          <span class="text-xl text-[#2563EB]">💳</span>
                        </div>
                        <div>
                          <p class="font-bold text-gray-900">E-Wallet</p>
                          <p class="text-xs font-bold text-gray-500">Via gopay, ovo, dana</p>
                        </div>
                      </label>

                      <!-- Transfer Bank -->
                      <label class="flex items-center gap-4 p-4 rounded-xl border-2 cursor-pointer transition-all has-[:checked]:border-[#2563EB] has-[:checked]:bg-blue-50 border-gray-200 hover:border-blue-300">
                        <input type="radio" v-model="selectedPaymentMethod" value="transfer" class="hidden">
                        <div class="w-10 h-10 rounded-lg bg-blue-100 flex items-center justify-center shrink-0">
                          <span class="text-xl text-[#2563EB]">🏦</span>
                        </div>
                        <div>
                          <p class="font-bold text-gray-900">Transfer Bank</p>
                          <p class="text-xs font-bold text-gray-500">Transfer Bank</p>
                        </div>
                      </label>
                    </div>

                    <button type="button" class="w-full bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white py-4 rounded-xl font-bold text-sm hover:shadow-lg hover:shadow-blue-500/30 active:scale-95 transition-all focus:outline-none focus:ring-2 focus:ring-blue-100" @click="submitBooking">
                      Bayar Sekarang
                    </button>
                  </div>
                </div>
              </div>
            </template>
</div>
</template>

<script setup>
import { computed, ref } from 'vue'
import { router } from '@inertiajs/vue3'

const props = defineProps({
  tutors: { type: Array, default: () => [] }
})

const emit = defineEmits(['navigate'])

const cariTutorQuery = ref('')
const cariTutorFilter = ref('Semua')
const cariView = ref('semua')
const showPaymentModal = ref(false)
const selectedPaymentMethod = ref('qris')
const selectedPackage = ref('4x')
const selectedMethod = ref('rumah')

// Kategori dinamis berdasarkan mata pelajaran tutor yang tersedia
const cariTutorCategories = computed(() => {
  const subjects = new Set(['Semua']);
  props.tutors.forEach(t => t.subjects.forEach(s => subjects.add(s.name)));
  return Array.from(subjects);
});

// Menyimpan tutor yang diklik untuk dilihat detailnya
const selectedTutor = ref(null);

const filteredCariTutor = computed(() => {
  let items = [...props.tutors]
  if (cariTutorFilter.value !== 'Semua') {
      items = items.filter(item => item.subjects.some(s => s.name === cariTutorFilter.value))
  }
  if (cariTutorQuery.value) {
    const q = cariTutorQuery.value.toLowerCase()
    items = items.filter(item => 
        item.name.toLowerCase().includes(q) || 
        item.subjects.some(s => s.name.toLowerCase().includes(q))
    )
  }
  return items
})

function viewTutor(tutor) {
    selectedTutor.value = tutor;
    cariView.value = 'profil';
}

function bookTutor() {
    cariView.value = 'pesan_tutor';
}

function submitBooking() {
    router.post('/booking-tutor', {
        tutor_id: selectedTutor.value.id,
        subject_id: selectedTutor.value.subjects[0].id, 
        metode_belajar: selectedMethod.value,
        paket_mengajar: selectedPackage.value
    }, {
        onSuccess: () => {
            showPaymentModal.value = false;
            cariView.value = 'menunggu_konfirmasi';
        }
    });
}

function goNav(id) { emit('navigate', id) }
</script>
