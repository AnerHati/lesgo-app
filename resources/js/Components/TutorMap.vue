<template>
  <div>
    <!-- Map Radius Search View -->
    <div v-if="view === 'lokasi'" class="animate-fade-in">
      <div class="mb-4">
        <button @click="$emit('back', 'semua')" type="button" class="bg-white border border-gray-200 text-gray-700 px-4 py-2 rounded-lg font-bold text-sm inline-flex items-center gap-2 hover:bg-gray-50 transition shadow-sm">
          <span aria-hidden="true">←</span> Kembali
        </button>
      </div>
      
      <p class="text-gray-500 font-medium mb-4">Ditemukan {{ filteredTutors.length }} tutor terdekat dalam 2 km</p>

      <div class="bg-white rounded-[24px] border border-gray-200 shadow-sm overflow-hidden flex flex-col">
        <!-- Top Filter Bar -->
        <div class="p-6 border-b border-gray-100 flex flex-col md:flex-row md:items-center justify-between gap-6">
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
          <iframe 
            class="absolute inset-0 w-full h-full"
            frameborder="0" 
            scrolling="no" 
            marginheight="0" 
            marginwidth="0" 
            src="https://www.openstreetmap.org/export/embed.html?bbox=115.18%2C-8.72%2C115.28%2C-8.62&amp;layer=mapnik&amp;marker=-8.670%2C115.230">
          </iframe>
          
          <div class="absolute inset-0 pointer-events-none">
            <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 flex items-center justify-center">
              <div class="absolute w-[350px] h-[350px] rounded-full border-2 border-blue-200 bg-blue-50/10"></div>
              <div class="absolute w-[250px] h-[250px] rounded-full border-2 border-blue-300 bg-blue-50/20"></div>
              <div class="absolute w-[150px] h-[150px] rounded-full border-2 border-blue-400 bg-blue-100/30 flex items-center justify-center">
                <div class="w-16 h-16 bg-blue-200/50 rounded-full flex items-center justify-center">
                   <svg class="w-12 h-12 text-red-600 drop-shadow-md transform -translate-y-4" viewBox="0 0 24 24" fill="currentColor">
                      <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/>
                   </svg>
                </div>
              </div>
            </div>

            <!-- Mock Tutor Pins -->
            <div class="absolute top-[20%] left-[30%] bg-white rounded-full p-1 pr-3 flex items-center gap-2 shadow-lg border border-gray-100">
              <img src="https://ui-avatars.com/api/?name=Tutor&background=eff6ff&color=2563eb" class="w-8 h-8 rounded-full">
              <div>
                <p class="text-xs font-black text-gray-900 leading-none">Iqbal</p>
                <p class="text-[10px] font-bold text-gray-500 flex items-center mt-0.5"><span class="text-amber-400">⭐</span> 4.7</p>
              </div>
            </div>
            <div class="absolute top-[30%] right-[25%] bg-white rounded-full p-1 pr-3 flex items-center gap-2 shadow-lg border border-gray-100">
              <img src="https://ui-avatars.com/api/?name=Alvian&background=eff6ff&color=2563eb" class="w-8 h-8 rounded-full">
              <div>
                <p class="text-xs font-black text-gray-900 leading-none">Alvian</p>
                <p class="text-[10px] font-bold text-gray-500 flex items-center mt-0.5"><span class="text-amber-400">⭐</span> 4.9</p>
              </div>
            </div>
          </div>
        </div>

        <!-- Tutor List -->
        <div class="grid grid-cols-1 md:grid-cols-2 bg-white gap-0">
          <div 
            v-for="(tutor, index) in filteredTutors" 
            :key="'map-list-'+tutor.id"
            class="flex items-center justify-between p-4 border-b border-gray-200 hover:bg-gray-50 cursor-pointer transition" 
            :class="{ 'md:border-r': index % 2 === 0 }"
            @click="$emit('view-tutor', tutor)"
          >
            <div class="flex items-center gap-3">
              <img :src="`https://ui-avatars.com/api/?name=${tutor.name.replace(/ /g, '+')}&background=eff6ff&color=2563eb`" class="w-12 h-12 rounded-full">
              <div>
                <h4 class="text-sm font-black text-gray-900">{{ tutor.name }}</h4>
                <div class="flex items-center gap-1 text-xs font-bold text-gray-500 mt-0.5">
                  <span class="text-amber-400">⭐⭐⭐⭐⭐</span> {{ tutor.rating || '5.0' }}
                </div>
              </div>
            </div>
            <div class="text-xs font-bold text-gray-500 flex items-center gap-1">
              <span class="text-gray-400">◎</span> {{ tutor.distance || '2.5' }}km
            </div>
          </div>
          
          <div v-if="filteredTutors.length === 0" class="col-span-2 p-8 text-center text-gray-400 font-bold">
             Tidak ada tutor yang terdeteksi di area ini.
          </div>
        </div>
      </div>
    </div>

    <!-- Lokasi Tutor View (Detail Map) -->
    <div v-else-if="view === 'lokasi_detail'" class="animate-fade-in">
      <div class="mb-6">
        <button @click="$emit('back', 'profil')" type="button" class="bg-white border border-gray-200 text-gray-700 px-4 py-2 rounded-lg font-bold text-sm inline-flex items-center gap-2 hover:bg-gray-50 transition shadow-sm">
          <span aria-hidden="true">←</span> Kembali
        </button>
      </div>
      <h2 class="text-3xl font-black mb-6 text-gray-900">Lokasi Tutor</h2>

      <div class="relative w-full h-[400px] rounded-2xl overflow-hidden border border-gray-200 shadow-sm bg-gray-100">
        <iframe 
          class="absolute inset-0 w-full h-full"
          frameborder="0" 
          scrolling="no" 
          marginheight="0" 
          marginwidth="0" 
          src="https://www.openstreetmap.org/export/embed.html?bbox=115.18%2C-8.72%2C115.28%2C-8.62&amp;layer=mapnik&amp;marker=-8.670%2C115.230">
        </iframe>
        
        <div class="absolute inset-0 flex items-center justify-center pointer-events-none">
          <div class="w-64 h-64 rounded-full border-[6px] border-white shadow-[0_0_0_9999px_rgba(255,255,255,0.4)] flex items-center justify-center relative overflow-hidden">
             <svg class="w-20 h-20 text-red-600 drop-shadow-xl absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-full" viewBox="0 0 24 24" fill="currentColor">
                <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/>
             </svg>
          </div>
        </div>

        <div class="absolute bottom-6 right-6 flex flex-col gap-3">
          <button type="button" class="bg-[#2563EB] text-white px-5 py-2.5 rounded-xl font-bold text-sm shadow-lg flex items-center gap-2 hover:bg-blue-700 transition">
            📍 Buka di Google Maps
          </button>
          <button type="button" class="bg-white text-blue-600 px-5 py-2.5 rounded-xl font-bold text-sm shadow-lg flex items-center gap-2 hover:bg-gray-50 transition">
            🔺 Rute ke Lokasi
          </button>
        </div>
      </div>

      <div class="bg-white rounded-b-3xl border-x border-b border-gray-200 shadow-sm p-8 relative -mt-4 z-10 mx-2">
        <div class="md:absolute md:-top-12 md:right-8 bg-white rounded-2xl border border-gray-100 shadow-[0_8px_30px_rgb(0,0,0,0.08)] p-5 flex gap-5 md:w-80 w-full mb-6 md:mb-0" v-if="selectedTutor">
          <div class="w-16 h-16 rounded-full bg-blue-50 overflow-hidden shrink-0 flex items-center justify-center text-3xl border border-blue-100">
            <img :src="`https://ui-avatars.com/api/?name=${selectedTutor.name.replace(/ /g, '+')}&background=eff6ff&color=2563eb`" :alt="selectedTutor.name" class="w-full h-full object-cover">
          </div>
          <div>
            <h4 class="text-xl font-black text-[#2563EB] leading-tight">{{ selectedTutor.name }}</h4>
            <p class="text-xs font-bold text-gray-500 mt-1">{{ selectedTutor.subjects?.[0]?.name || 'Umum' }}</p>
            <p class="text-[10px] text-gray-400 mt-1 font-semibold flex items-center gap-1">🎓 Tutor SD - SMA</p>
            <div class="flex items-center gap-1 mt-2 text-xs font-bold">
              <span class="text-amber-400 text-sm">⭐⭐⭐⭐⭐</span>
              <span class="text-gray-600 ml-1">{{ selectedTutor.rating || '5.0' }}</span>
            </div>
          </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
          <div class="space-y-8">
            <div class="space-y-4">
              <div class="flex items-center gap-3 text-sm font-bold text-gray-700">
                <span class="text-gray-400 text-lg w-5 text-center">📍</span> {{ selectedTutor?.address || 'Denpasar Selatan' }}
              </div>
              <div class="flex items-center gap-3 text-sm font-bold text-gray-700">
                <span class="text-gray-400 text-lg w-5 text-center">◎</span> Sekitar {{ selectedTutor?.distance || '2' }}km dari rumah kamu
              </div>
            </div>

            <div>
              <h3 class="font-black text-gray-900 mb-5 text-lg">Pilih Metode Belajar</h3>
              <div class="space-y-5">
                <div class="flex items-start gap-4">
                  <span class="text-gray-400 text-xl w-5 text-center mt-0.5">🏠</span>
                  <div>
                    <p class="text-sm font-bold text-gray-800">Tutor datang ke rumah kamu</p>
                    <p class="text-xs font-bold text-[#2563EB] mt-1">Area: {{ selectedTutor?.address || 'Domisili' }}</p>
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

          <div class="flex flex-col justify-end items-end gap-3 md:pt-20">
            <div class="flex flex-wrap gap-3 justify-end w-full">
              <button type="button" class="bg-[#2563EB] text-white px-6 py-3 rounded-xl font-bold text-sm shadow-sm flex items-center gap-2 hover:bg-blue-700 transition">
                📞 Hubungi Tutor
              </button>
              <button @click="$emit('book-tutor')" type="button" class="bg-[#2563EB] text-white px-6 py-3 rounded-xl font-bold text-sm shadow-sm flex items-center gap-2 hover:bg-blue-700 transition">
                📅 Booking Sekarang
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
const props = defineProps({
  filteredTutors: { type: Array, default: () => [] },
  selectedTutor: { type: Object, default: null },
  view: { type: String, required: true }
})

const emit = defineEmits(['back', 'view-tutor', 'book-tutor'])
</script>
