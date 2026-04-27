<template>
          <div class="max-w-6xl mx-auto w-full space-y-6 animate-fade-in">
             <!-- View: Semua -->
             <template v-if="cariTutorView === 'semua'">
               <!-- Header & Filter -->
               <div class="bg-white rounded-[32px] border border-gray-100 p-8 shadow-sm relative overflow-hidden">
                 <div class="absolute inset-0 bg-gradient-to-r from-blue-50/50 to-transparent"></div>
                 <div class="relative z-10 flex flex-col md:flex-row justify-between items-start md:items-center gap-6">
                   <div>
                     <h2 class="text-3xl font-black text-gray-900 mb-2">Cari Tutor</h2>
                     <p class="text-gray-500 font-medium text-sm">Cari tutor terbaik dan terdekat sesuai kebutuhan anak Anda.</p>
                     <p class="text-gray-500 font-medium text-sm">Lihat profil tutor dan mulai sesi belajar anak Anda.</p>
                   </div>
                   <button @click="cariTutorView = 'terdekat'" class="bg-[#2563EB] text-white px-6 py-3 rounded-xl font-bold text-sm flex items-center gap-2 hover:bg-blue-700 transition shadow-md shadow-blue-500/20 active:scale-95">
                     <span>📍</span> Cari Tutor Terdekat
                   </button>
                 </div>
               </div>

               <!-- Tabs Filter -->
               <div class="flex items-center gap-3">
                 <div class="flex flex-wrap items-center bg-white border border-gray-200 rounded-xl p-1 gap-1">
                   <button 
                     v-for="cat in tutorCategories" :key="cat"
                     @click="tutorCategoryFilter = cat"
                     class="px-6 py-2.5 rounded-lg text-sm font-bold transition-all"
                     :class="tutorCategoryFilter === cat ? 'bg-[#2563EB] text-white shadow-sm' : 'text-gray-600 hover:text-gray-900 hover:bg-gray-50'"
                   >
                     {{ cat }}
                   </button>
                 </div>
                 <button class="w-11 h-11 bg-white border border-gray-200 rounded-xl flex items-center justify-center text-gray-500 hover:bg-gray-50 hover:text-gray-700 transition">
                   <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path></svg>
                 </button>
               </div>

               <!-- Grid of Cards -->
               <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                 <article v-for="tutor in tutorList" :key="tutor.id" class="bg-white rounded-[24px] border border-gray-100 p-6 shadow-[0_4px_20px_rgb(0,0,0,0.03)] hover:shadow-lg hover:-translate-y-1 transition-all duration-300 flex flex-col">
                   <div class="flex gap-4 mb-4">
                     <div class="w-16 h-16 rounded-full overflow-hidden shrink-0 border border-gray-100 bg-gray-50">
                       <img :src="`https://ui-avatars.com/api/?name=${tutor.name.replace(' ','+')}&background=f3f4f6&color=374151&size=128`" class="w-full h-full object-cover">
                     </div>
                     <div>
                       <h3 class="text-lg font-black text-[#0EA5E9] leading-tight mb-0.5">{{ tutor.name }}</h3>
                       <p class="text-[11px] font-bold text-gray-500 mb-1.5">{{ tutor.subject }}</p>
                       <p class="text-[10px] text-gray-400 font-semibold flex items-center gap-1.5 mb-1"><span class="text-lg">🎓</span> {{ tutor.level }}</p>
                       <div class="flex items-center gap-1 text-[11px] font-bold text-gray-600">
                         <span class="text-[#FACC15] text-sm tracking-tighter">★★★★★</span> <span class="ml-1">{{ tutor.rating }}</span>
                       </div>
                     </div>
                   </div>
                   <p class="text-[11px] text-gray-500 font-medium leading-relaxed mb-6">{{ tutor.desc }}</p>
                   <button @click="cariTutorView = 'detail_profil'" class="mt-auto w-full py-2.5 rounded-xl border border-blue-200 text-[#2563EB] font-bold text-sm hover:bg-blue-50 hover:border-blue-300 transition-colors">
                     Lihat Profil
                   </button>
                 </article>
               </div>

               <!-- Pagination -->
               <div class="flex justify-center items-center gap-2 pt-4 pb-8">
                 <button class="w-10 h-10 rounded-lg flex items-center justify-center bg-[#2563EB] text-white font-bold shadow-sm">1</button>
                 <button class="w-10 h-10 rounded-lg flex items-center justify-center bg-white border border-gray-200 text-gray-600 hover:bg-gray-50 font-medium">2</button>
                 <button class="w-10 h-10 rounded-lg flex items-center justify-center bg-white border border-gray-200 text-gray-600 hover:bg-gray-50 font-medium">3</button>
                 <button class="w-10 h-10 rounded-lg flex items-center justify-center bg-white border border-gray-200 text-gray-600 hover:bg-gray-50 font-medium">4</button>
                 <button class="w-10 h-10 rounded-lg flex items-center justify-center bg-white border border-gray-200 text-gray-600 hover:bg-gray-50 font-medium">5</button>
                 <button class="w-10 h-10 rounded-lg flex items-center justify-center bg-white border border-gray-200 text-gray-400 hover:bg-gray-50 hover:text-gray-600 focus:outline-none">›</button>
               </div>
             </template>

             <!-- View: Terdekat (Map) -->
             <template v-else-if="cariTutorView === 'terdekat'">
               <div>
                 <button @click="cariTutorView = 'semua'" class="bg-white border border-gray-200 text-gray-700 px-5 py-2.5 rounded-xl font-bold text-sm flex items-center gap-2 hover:bg-gray-50 transition shadow-sm mb-6">
                   <span aria-hidden="true">←</span> Kembali
                 </button>
                 <p class="text-sm font-medium text-gray-600 mb-4">Ditemukan {{ tutorTerdekatList.length }} tutor terdekat dalam 2 km</p>
                 
                 <div class="bg-white rounded-[32px] border border-gray-200 shadow-sm overflow-hidden flex flex-col">
                   <!-- Controls -->
                   <div class="p-5 lg:p-6 border-b border-gray-100 flex flex-col lg:flex-row gap-6 lg:items-center justify-between">
                     <div class="flex-1 max-w-xl flex items-center gap-4">
                       <span class="text-sm font-bold text-gray-900 shrink-0">Radius: 2 km</span>
                       <div class="flex-1 relative flex items-center h-8">
                         <div class="absolute inset-x-0 h-2 bg-blue-100 rounded-full"></div>
                         <div class="absolute left-0 h-2 bg-[#3B82F6] rounded-full w-[15%]"></div>
                         <div class="absolute left-[15%] w-6 h-6 bg-[#F59E0B] rounded-full border-4 border-white shadow transform -translate-x-1/2 cursor-pointer z-10 hover:scale-110 transition-transform"></div>
                       </div>
                       <span class="text-sm font-bold text-gray-900 shrink-0">15 km</span>
                     </div>
                     <div class="flex items-center gap-3">
                       <div class="relative">
                         <select class="appearance-none bg-white border border-gray-200 rounded-xl px-4 py-2.5 pr-10 text-sm font-medium text-gray-700 focus:ring-2 focus:ring-blue-100 outline-none">
                           <option>Semua</option>
                         </select>
                         <span class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 pointer-events-none">›</span>
                       </div>
                       <div class="relative">
                         <select class="appearance-none bg-white border border-gray-200 rounded-xl px-4 py-2.5 pr-10 text-sm font-medium text-gray-700 focus:ring-2 focus:ring-blue-100 outline-none">
                           <option>Matematika</option>
                         </select>
                         <span class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 pointer-events-none">›</span>
                       </div>
                       <button class="bg-[#2563EB] text-white px-6 py-2.5 rounded-xl font-bold text-sm shadow-sm hover:bg-blue-700 transition flex items-center gap-2">
                         Filter <span>›</span>
                       </button>
                     </div>
                   </div>

                   <!-- Map View -->
                   <div class="relative w-full h-[450px] bg-gray-100 overflow-hidden border-b border-gray-100">
                     <iframe class="absolute inset-0 w-full h-full" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://www.openstreetmap.org/export/embed.html?bbox=115.18%2C-8.72%2C115.28%2C-8.62&amp;layer=mapnik&amp;marker=-8.670%2C115.230"></iframe>
                     
                     <div class="absolute inset-0 pointer-events-none">
                       <!-- Radius Rings -->
                       <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 flex items-center justify-center">
                         <div class="absolute w-[300px] h-[300px] rounded-full border-[3px] border-[#3B82F6] bg-blue-50/30"></div>
                         <div class="absolute w-[500px] h-[500px] rounded-full border border-blue-200"></div>
                         <!-- Pin Center -->
                         <div class="absolute -mt-10">
                           <svg class="w-14 h-14 text-red-600 drop-shadow-xl" viewBox="0 0 24 24" fill="currentColor">
                             <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/>
                           </svg>
                         </div>
                       </div>

                       <!-- Floating Tutors -->
                       <div class="absolute top-[20%] left-[30%] bg-white rounded-full p-1.5 pr-4 flex items-center gap-2 shadow-lg border border-gray-100 transform -translate-x-1/2 -translate-y-1/2 cursor-pointer pointer-events-auto hover:scale-105 transition">
                         <img src="https://ui-avatars.com/api/?name=Iqbal&background=f3f4f6&color=374151" class="w-10 h-10 rounded-full border border-gray-100">
                         <div>
                           <p class="text-xs font-black text-gray-900 leading-tight">Iqbal</p>
                           <div class="flex items-center text-[10px] font-bold text-gray-600 gap-0.5 mt-0.5">
                             <span class="text-[#FACC15]">★</span> 4.7 <span class="text-gray-400 font-medium">4.7</span>
                           </div>
                         </div>
                         <div class="absolute -bottom-2.5 left-1/2 -translate-x-1/2 w-4 h-4 bg-[#F59E0B] rounded-full border-2 border-white shadow-sm"></div>
                       </div>

                       <div class="absolute top-[30%] right-[25%] bg-white rounded-full p-1.5 pr-4 flex items-center gap-2 shadow-lg border border-gray-100 transform -translate-x-1/2 -translate-y-1/2 cursor-pointer pointer-events-auto hover:scale-105 transition">
                         <img src="https://ui-avatars.com/api/?name=Alvian&background=f3f4f6&color=374151" class="w-10 h-10 rounded-full border border-gray-100">
                         <div>
                           <p class="text-xs font-black text-gray-900 leading-tight">Alvian</p>
                           <div class="flex items-center text-[10px] font-bold text-gray-600 gap-0.5 mt-0.5">
                             <span class="text-[#FACC15]">★</span> 4.9 <span class="text-gray-400 font-medium">4.9</span>
                           </div>
                         </div>
                         <div class="absolute -bottom-2.5 left-1/2 -translate-x-1/2 w-4 h-4 bg-[#F59E0B] rounded-full border-2 border-white shadow-sm"></div>
                       </div>

                       <div class="absolute bottom-[20%] right-[35%] bg-white rounded-full p-1.5 pr-4 flex items-center gap-2 shadow-lg border border-gray-100 transform -translate-x-1/2 -translate-y-1/2 cursor-pointer pointer-events-auto hover:scale-105 transition">
                         <img src="https://ui-avatars.com/api/?name=Tania&background=f3f4f6&color=374151" class="w-10 h-10 rounded-full border border-gray-100">
                         <div>
                           <p class="text-xs font-black text-gray-900 leading-tight">Tania</p>
                           <div class="flex items-center text-[10px] font-bold text-gray-600 gap-0.5 mt-0.5">
                             <span class="text-[#FACC15]">★</span> 4.6 <span class="text-gray-400 font-medium">4.6</span>
                           </div>
                         </div>
                         <div class="absolute -bottom-2.5 left-1/2 -translate-x-1/2 w-4 h-4 bg-[#F59E0B] rounded-full border-2 border-white shadow-sm"></div>
                       </div>
                       
                       <div class="absolute bottom-[25%] left-[40%] bg-white rounded-full p-1.5 pr-4 flex items-center gap-2 shadow-lg border border-gray-100 transform -translate-x-1/2 -translate-y-1/2 cursor-pointer pointer-events-auto hover:scale-105 transition">
                         <img src="https://ui-avatars.com/api/?name=Alvian&background=f3f4f6&color=374151" class="w-10 h-10 rounded-full border border-gray-100">
                         <div>
                           <p class="text-xs font-black text-gray-900 leading-tight">Alvian</p>
                           <div class="flex items-center text-[10px] font-bold text-gray-600 gap-0.5 mt-0.5">
                             <span class="text-[#FACC15]">★</span> 4.9 <span class="text-gray-400 font-medium">4.9</span>
                           </div>
                         </div>
                         <div class="absolute -bottom-2.5 left-1/2 -translate-x-1/2 w-4 h-4 bg-[#F59E0B] rounded-full border-2 border-white shadow-sm"></div>
                       </div>
                     </div>
                   </div>

                   <!-- List Under Map -->
                   <div class="grid grid-cols-1 md:grid-cols-2 bg-white">
                     <div v-for="(tutor, i) in tutorTerdekatList" :key="tutor.id"
                       @click="cariTutorView = 'detail_profil'"
                       class="flex items-center justify-between p-5 lg:px-8 lg:py-6 border-b border-gray-100 hover:bg-gray-50 transition cursor-pointer"
                       :class="{ 'md:border-r border-gray-100': i % 2 === 0 }"
                     >
                       <div class="flex items-center gap-4">
                         <div class="w-12 h-12 rounded-full overflow-hidden border border-gray-200 shadow-sm shrink-0">
                           <img :src="`https://ui-avatars.com/api/?name=${tutor.name.replace(' ','+')}&background=f3f4f6&color=374151&size=100`" class="w-full h-full object-cover">
                         </div>
                         <div>
                           <h4 class="text-sm font-black text-gray-900 leading-tight mb-0.5">{{ tutor.name }}</h4>
                           <div class="flex items-center text-[11px] font-bold text-gray-500 gap-1">
                             <span class="text-[#FACC15] text-sm tracking-tighter">★★★★★</span> {{ tutor.rating }}
                           </div>
                         </div>
                       </div>
                       <div class="text-xs font-bold text-gray-500 flex items-center gap-1.5">
                         <span class="text-gray-400">◎</span> {{ tutor.distance }}
                       </div>
                     </div>
                   </div>

                 </div>
               </div>
             </template>

             <!-- View: Detail Profil -->
             <template v-else-if="cariTutorView === 'detail_profil'">
               <div>
                 <button @click="cariTutorView = 'semua'" class="bg-white border border-gray-200 text-gray-700 px-5 py-2.5 rounded-xl font-bold text-sm flex items-center gap-2 hover:bg-gray-50 transition shadow-sm mb-6 w-fit">
                   <span aria-hidden="true">←</span> Kembali
                 </button>
                 
                 <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                   <!-- Main Detail Column -->
                   <div class="lg:col-span-2 space-y-6">
                     <div class="bg-white rounded-[32px] border border-gray-100 p-8 shadow-sm relative overflow-hidden group">
                       <div class="absolute inset-0 bg-gradient-to-br from-indigo-50/50 via-white to-transparent opacity-50"></div>
                       <div class="relative z-10">
                         <div class="flex flex-col sm:flex-row gap-6 items-start sm:items-center mb-6">
                           <div class="w-24 h-24 rounded-full overflow-hidden shrink-0 border-4 border-white shadow-md">
                             <img src="https://ui-avatars.com/api/?name=Isyana+Randini&background=f3f4f6&color=374151&size=200" class="w-full h-full object-cover">
                           </div>
                           <div>
                             <h2 class="text-2xl font-black text-gray-900 leading-tight mb-1">Isyana Randini</h2>
                             <div class="flex items-center gap-1 text-sm font-bold text-gray-600 mb-2">
                               <span class="text-[#FACC15] text-lg tracking-tighter">★★★★★</span> <span class="mt-0.5">4.7</span>
                             </div>
                             <div class="space-y-1">
                               <p class="text-xs font-bold text-gray-500 flex items-center gap-2"><span class="text-lg">🎓</span> Matematika</p>
                               <p class="text-xs font-bold text-gray-500 flex items-center gap-2"><span class="text-lg">📍</span> Denpasar Selatan</p>
                             </div>
                           </div>
                         </div>
                         <div class="bg-blue-50/50 rounded-2xl p-4 text-xs font-medium text-gray-600 leading-relaxed border border-blue-100">
                           Tutor berpengalaman mengajar SD-SMA. Spesialis dalam aljabar, geometri, dan trigonometri. Sabar dan membuat belajar jadi menyenangkan!
                         </div>
                       </div>
                     </div>

                     <div class="bg-white rounded-[32px] border border-gray-100 p-8 shadow-sm">
                       <div class="space-y-8">
                         <div>
                           <h3 class="text-sm font-bold text-green-600 flex items-center gap-2 mb-4"><span class="w-5 h-5 rounded-full bg-green-100 flex items-center justify-center">✓</span> Kursus yang diajarkan</h3>
                           <ul class="space-y-2.5 ml-7">
                             <li class="text-xs font-bold text-gray-600 flex items-center gap-2"><span class="text-gray-400">🎓</span> SD-SMA</li>
                             <li class="text-xs font-bold text-gray-600 flex items-center gap-2"><span class="text-gray-400">📘</span> Matematika</li>
                           </ul>
                         </div>
                         <div>
                           <h3 class="text-sm font-bold text-green-600 flex items-center gap-2 mb-4"><span class="w-5 h-5 rounded-full bg-green-100 flex items-center justify-center">✓</span> Pengalaman Mengajar</h3>
                           <ul class="space-y-2.5 ml-7">
                             <li class="text-xs font-bold text-gray-600 flex items-center gap-2"><span class="text-gray-400">🕒</span> 10 Tahun mengajar matematika</li>
                           </ul>
                         </div>
                         <div>
                           <h3 class="text-sm font-bold text-green-600 flex items-center gap-2 mb-4"><span class="w-5 h-5 rounded-full bg-green-100 flex items-center justify-center">✓</span> Preferensi Lokasi Mengajar</h3>
                           <ul class="space-y-2.5 ml-7">
                             <li class="text-xs font-bold text-gray-600 flex items-center gap-2"><span class="text-gray-400">📍</span> Datangi rumah siswa sekitar Denpasar Selatan</li>
                             <li class="text-xs font-bold text-gray-600 flex items-center gap-2"><span class="text-gray-400">💻</span> Online zoom/Google Meet</li>
                           </ul>
                         </div>
                       </div>
                     </div>
                   </div>

                   <!-- Side Column (Map & Pricing) -->
                   <div class="space-y-6">
                     <div class="bg-white rounded-[32px] border border-gray-100 p-4 shadow-sm">
                       <div class="rounded-2xl overflow-hidden relative h-48 mb-4 border border-gray-100">
                         <iframe class="absolute inset-0 w-full h-full" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://www.openstreetmap.org/export/embed.html?bbox=115.18%2C-8.72%2C115.28%2C-8.62&amp;layer=mapnik&amp;marker=-8.670%2C115.230"></iframe>
                         <div class="absolute inset-0 bg-black/5 pointer-events-none"></div>
                         <div class="absolute inset-0 flex items-center justify-center pointer-events-none">
                           <div class="w-32 h-32 bg-blue-500/20 rounded-full border-2 border-blue-500 flex items-center justify-center">
                             <svg class="w-10 h-10 text-red-600 drop-shadow-md -mt-6" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/></svg>
                           </div>
                         </div>
                         <button @click="cariTutorView = 'detail_lokasi'" class="absolute bottom-3 right-3 bg-[#2563EB] text-white px-4 py-2 rounded-lg font-bold text-xs shadow-md hover:bg-blue-700 transition flex items-center gap-1.5">
                           <span>📍</span> Lihat Lokasi
                         </button>
                       </div>
                       <p class="text-xs font-bold text-gray-600 flex items-center gap-2 px-2"><span class="text-gray-400">👤</span> Sekitar 2 km dari rumah Anda</p>
                     </div>

                     <div class="bg-white rounded-[32px] border border-gray-100 p-6 shadow-sm">
                       <h3 class="font-bold text-gray-900 mb-4">Biaya Mengajar</h3>
                       <div class="space-y-0">
                         <div class="flex justify-between items-center py-3 border-b border-gray-50">
                           <span class="text-xs font-bold text-gray-600">Privat di rumah</span>
                           <div class="text-right">
                             <span class="text-[10px] text-gray-400 font-medium">1 Jam</span>
                             <span class="text-xs font-bold text-gray-900 ml-2">Rp100.000</span>
                           </div>
                         </div>
                         <div class="flex justify-between items-center py-3 border-b border-gray-50">
                           <span class="text-xs font-bold text-gray-600">Grup (2-4 Orang)</span>
                           <div class="text-right">
                             <span class="text-[10px] text-gray-400 font-medium">1 Jam/orang</span>
                             <span class="text-xs font-bold text-gray-900 ml-2">Rp75.000</span>
                           </div>
                         </div>
                         <div class="flex justify-between items-center py-3">
                           <span class="text-xs font-bold text-gray-600">Online via Zoom/Meet</span>
                           <div class="text-right">
                             <span class="text-[10px] text-gray-400 font-medium">1 Jam</span>
                             <span class="text-xs font-bold text-gray-900 ml-2">Rp80.000</span>
                           </div>
                         </div>
                       </div>
                       <button class="w-full mt-4 bg-[#2563EB] text-white py-3 rounded-xl font-bold text-sm shadow-sm hover:bg-blue-700 transition">
                         Hubungi Tutor
                       </button>
                     </div>
                   </div>
                 </div>
               </div>
             </template>

             <!-- View: Detail Lokasi -->
             <template v-else-if="cariTutorView === 'detail_lokasi'">
               <div>
                 <button @click="cariTutorView = 'detail_profil'" class="bg-white border border-gray-200 text-gray-700 px-5 py-2.5 rounded-xl font-bold text-sm flex items-center gap-2 hover:bg-gray-50 transition shadow-sm mb-6 w-fit">
                   <span aria-hidden="true">←</span> Kembali
                 </button>
                 <h2 class="text-3xl font-black text-gray-900 mb-6">Lokasi Tutor</h2>
                 
                 <div class="bg-white rounded-[32px] border border-gray-100 p-4 shadow-sm overflow-hidden flex flex-col gap-6">
                   <!-- Big Map -->
                   <div class="relative w-full h-[400px] rounded-[24px] overflow-hidden border border-gray-100">
                     <iframe class="absolute inset-0 w-full h-full" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://www.openstreetmap.org/export/embed.html?bbox=115.18%2C-8.72%2C115.28%2C-8.62&amp;layer=mapnik&amp;marker=-8.670%2C115.230"></iframe>
                     <div class="absolute inset-0 bg-black/5 pointer-events-none"></div>
                     <div class="absolute inset-0 flex items-center justify-center pointer-events-none">
                       <div class="w-64 h-64 bg-white/20 backdrop-blur-sm rounded-full border-4 border-white/50 flex items-center justify-center shadow-2xl">
                         <svg class="w-24 h-24 text-red-600 drop-shadow-xl -mt-12" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/></svg>
                       </div>
                     </div>
                     <div class="absolute bottom-6 right-6 flex flex-col gap-2">
                       <button class="bg-[#2563EB] text-white px-5 py-2.5 rounded-xl font-bold text-xs shadow-lg hover:bg-blue-700 transition flex items-center justify-center gap-2">
                         <span>📍</span> Buka di Google Maps
                       </button>
                       <button class="bg-white text-[#2563EB] px-5 py-2.5 rounded-xl font-bold text-xs shadow-lg border border-gray-100 hover:bg-gray-50 transition flex items-center justify-center gap-2">
                         <span>△</span> Rute ke Lokasi
                       </button>
                     </div>
                   </div>

                   <!-- Info & Actions -->
                   <div class="grid grid-cols-1 md:grid-cols-2 gap-6 p-2">
                     <div class="space-y-6">
                       <div class="space-y-2">
                         <p class="text-sm font-bold text-gray-600 flex items-center gap-2"><span class="text-lg">📍</span> Denpasar Selatan</p>
                         <p class="text-sm font-bold text-gray-600 flex items-center gap-2"><span class="text-lg">🏠</span> Sekitar 2km dari rumah kamu</p>
                       </div>
                       
                       <div>
                         <h3 class="font-bold text-gray-900 mb-3">Pilih Metode Belajar</h3>
                         <div class="space-y-3">
                           <div class="flex items-start gap-3">
                             <span class="text-xl mt-0.5">🏠</span>
                             <div>
                               <p class="text-xs font-bold text-gray-800">Tutor datang ke rumah kamu</p>
                               <p class="text-[11px] text-blue-500 font-medium mt-0.5">Area: Denpasar Selatan</p>
                             </div>
                           </div>
                           <div class="flex items-start gap-3">
                             <span class="text-xl mt-0.5">💻</span>
                             <div>
                               <p class="text-xs font-bold text-gray-800">Online</p>
                               <p class="text-[11px] text-blue-500 font-medium mt-0.5">Zoom / Google Meet</p>
                             </div>
                           </div>
                         </div>
                       </div>
                     </div>

                     <div class="flex flex-col justify-between">
                       <!-- Tutor Mini Card -->
                       <div class="bg-white border border-gray-100 rounded-2xl p-4 flex gap-4 shadow-sm items-center self-start w-full sm:w-auto ml-auto">
                         <div class="w-14 h-14 rounded-full overflow-hidden shrink-0 border border-gray-100">
                           <img src="https://ui-avatars.com/api/?name=Isyana+Randini&background=f3f4f6&color=374151&size=100" class="w-full h-full object-cover">
                         </div>
                         <div>
                           <h4 class="text-sm font-black text-[#0EA5E9] leading-tight mb-1">Isyana Randini</h4>
                           <p class="text-[10px] text-gray-500 font-medium mb-1">Matematika</p>
                           <p class="text-[9px] text-gray-400 font-bold flex items-center gap-1 mb-1"><span>🎓</span> Tutor SD - SMA</p>
                           <div class="flex items-center gap-1 text-[10px] font-bold text-gray-600">
                             <span class="text-[#FACC15] tracking-tighter">★★★★★</span> <span class="ml-0.5">4.7</span>
                           </div>
                         </div>
                       </div>
                       
                       <div class="flex flex-col sm:flex-row gap-3 mt-6 sm:mt-0 pt-4">
                         <button class="flex-1 bg-white border-2 border-[#2563EB] text-[#2563EB] py-3 rounded-xl font-bold text-sm shadow-sm hover:bg-blue-50 transition flex items-center justify-center gap-2">
                           <span>📞</span> Hubungi Tutor
                         </button>
                         <button @click="cariTutorView = 'booking_tutor'" class="flex-1 bg-[#2563EB] text-white py-3 rounded-xl font-bold text-sm shadow-sm hover:bg-blue-700 transition flex items-center justify-center gap-2">
                           <span>📅</span> Booking Sekarang
                         </button>
                       </div>
                     </div>
                   </div>

                 </div>
               </div>
             </template>

             <!-- View: Pesan Tutor (Booking Form) -->
             <template v-else-if="cariTutorView === 'booking_tutor'">
               <div>
                 <button @click="cariTutorView = 'detail_lokasi'" class="bg-white border border-gray-200 text-gray-700 px-5 py-2.5 rounded-xl font-bold text-sm flex items-center gap-2 hover:bg-gray-50 transition shadow-sm mb-6 w-fit">
                   <span aria-hidden="true">←</span> Kembali
                 </button>
                 <h2 class="text-3xl font-black text-gray-900 mb-6">Pesan Tutor</h2>
                 
                 <div class="bg-white rounded-[32px] border border-gray-100 p-8 shadow-sm">
                   <!-- Tutor Mini Card -->
                   <div class="flex flex-col sm:flex-row gap-6 items-center sm:items-start mb-8 pb-8 border-b border-gray-100">
                     <div class="w-24 h-24 rounded-full overflow-hidden shrink-0 border border-gray-100">
                       <img src="https://ui-avatars.com/api/?name=Isyana+Randini&background=f3f4f6&color=374151&size=200" class="w-full h-full object-cover">
                     </div>
                     <div class="text-center sm:text-left">
                       <h3 class="text-2xl font-black text-gray-900 leading-tight mb-2">Isyana Randini</h3>
                       <div class="flex items-center justify-center sm:justify-start gap-1 text-sm font-bold text-gray-600 mb-2">
                         <span class="text-[#FACC15] text-lg tracking-tighter">★★★★★</span>
                       </div>
                       <div class="space-y-1">
                         <p class="text-xs font-bold text-gray-500 flex items-center justify-center sm:justify-start gap-2"><span class="text-lg">🎓</span> Matematika</p>
                         <p class="text-xs font-bold text-gray-500 flex items-center justify-center sm:justify-start gap-2"><span class="text-lg">📍</span> Denpasar Selatan</p>
                       </div>
                     </div>
                   </div>

                   <h3 class="text-xl font-bold text-[#2563EB] mb-8">Pilih paket sesuai yang kamu mau.</h3>

                   <div class="space-y-8">
                     <!-- 1. Pilih Metode -->
                     <div>
                       <h4 class="font-bold text-gray-900 mb-4 text-lg">1. Pilih Metode Belajar</h4>
                       <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                         <label class="cursor-pointer">
                           <input type="radio" name="method" value="offline" v-model="selectedBookingMethod" class="peer sr-only">
                           <div class="p-5 border-2 rounded-2xl transition-all" :class="selectedBookingMethod === 'offline' ? 'border-[#2563EB] bg-blue-50/50' : 'border-gray-200 hover:border-gray-300'">
                             <div class="flex items-center gap-3 mb-2">
                               <span class="text-2xl">🏠</span>
                               <span class="font-bold text-gray-800 text-sm">Tutor datang ke rumah kamu</span>
                             </div>
                             <p class="text-xs font-medium text-[#2563EB] ml-9">Area: Denpasar Selatan</p>
                           </div>
                         </label>
                         <label class="cursor-pointer">
                           <input type="radio" name="method" value="online" v-model="selectedBookingMethod" class="peer sr-only">
                           <div class="p-5 border-2 rounded-2xl transition-all" :class="selectedBookingMethod === 'online' ? 'border-[#2563EB] bg-blue-50/50' : 'border-gray-200 hover:border-gray-300'">
                             <div class="flex items-center gap-3 mb-2">
                               <span class="text-2xl">💻</span>
                               <span class="font-bold text-gray-800 text-sm">Online</span>
                             </div>
                             <p class="text-xs font-medium text-[#2563EB] ml-9">Zoom / Google Meet</p>
                           </div>
                         </label>
                       </div>
                     </div>

                     <!-- 2. Pilih Paket -->
                     <div>
                       <h4 class="font-bold text-gray-900 mb-4 text-lg">2. Pilih Paket Mengajar</h4>
                       <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                         <label class="cursor-pointer relative">
                           <input type="radio" name="package" value="4x" v-model="selectedBookingPackage" class="peer sr-only">
                           <div class="p-5 border-2 rounded-2xl transition-all h-full" :class="selectedBookingPackage === '4x' ? 'border-[#2563EB] bg-blue-50/50' : 'border-gray-200 hover:border-gray-300'">
                             <h5 class="font-black text-gray-900 mb-2">4x Pertemuan</h5>
                             <div class="flex items-baseline gap-1 mb-2">
                               <span class="text-xl font-black text-gray-900">Rp400.000</span>
                               <span class="text-[10px] font-bold text-gray-400">sebulan</span>
                             </div>
                             <p class="text-[10px] font-bold text-gray-500">1 Minggu sekali selama 1 bulan</p>
                           </div>
                         </label>
                         <label class="cursor-pointer relative">
                           <input type="radio" name="package" value="8x" v-model="selectedBookingPackage" class="peer sr-only">
                           <div class="p-5 border-2 rounded-2xl transition-all h-full" :class="selectedBookingPackage === '8x' ? 'border-[#2563EB] bg-blue-50/50' : 'border-gray-200 hover:border-gray-300'">
                             <h5 class="font-black text-gray-900 mb-2">8x Pertemuan</h5>
                             <div class="flex items-baseline gap-1 mb-2">
                               <span class="text-xl font-black text-gray-900">Rp760.000</span>
                               <span class="text-[10px] font-bold text-gray-400">sebulan</span>
                             </div>
                             <p class="text-[10px] font-bold text-gray-500">2 Minggu sekali selama 1 bulan</p>
                           </div>
                         </label>
                         <label class="cursor-pointer relative">
                           <input type="radio" name="package" value="8x-hemat" v-model="selectedBookingPackage" class="peer sr-only">
                           <div class="p-5 border-2 rounded-2xl transition-all h-full" :class="selectedBookingPackage === '8x-hemat' ? 'border-[#2563EB] bg-blue-50/50' : 'border-gray-200 hover:border-gray-300'">
                             <div class="absolute -top-3 right-4 bg-[#2563EB] text-white text-[9px] font-black px-2 py-1 rounded-full shadow-sm">Paling Hemat</div>
                             <h5 class="font-black text-gray-900 mb-2">8x Pertemuan</h5>
                             <div class="flex items-baseline gap-1 mb-2">
                               <span class="text-xl font-black text-gray-900">Rp760.000</span>
                               <span class="text-[10px] font-bold text-gray-400">sebulan</span>
                             </div>
                             <p class="text-[10px] font-bold text-gray-500">2 Minggu sekali selama 1 bulan</p>
                           </div>
                         </label>
                       </div>
                     </div>

                     <!-- 3. Rincian Biaya -->
                     <div>
                       <h4 class="font-bold text-gray-900 mb-4 text-lg">3. Rincian Biaya Mengajar</h4>
                       <div class="border-2 border-gray-100 rounded-2xl overflow-hidden">
                         <div class="bg-gray-50/50 p-5 flex justify-between items-center border-b border-gray-100">
                           <h5 class="font-black text-gray-900">Paket 4x pertemuan</h5>
                           <span class="font-medium text-gray-600 text-sm">Rp400.000</span>
                         </div>
                         <div class="p-5 bg-white border-b border-gray-100">
                           <p class="text-xs font-bold text-gray-600">4x Pertemuan 1 jam x Rp100.000</p>
                         </div>
                         <div class="p-5 bg-white flex justify-between items-center">
                           <span class="text-sm font-bold text-gray-600">Total Estimasi</span>
                           <span class="text-2xl font-black text-gray-900">Rp400.000</span>
                         </div>
                       </div>
                       
                       <div class="mt-6 flex flex-col sm:flex-row items-center justify-between gap-4">
                         <p class="text-[10px] font-bold text-gray-400">Kamu bisa membayar setelah jadwal dikonfirmasi oleh tutor.</p>
                         <button @click="cariTutorView = 'menunggu_konfirmasi'" class="w-full sm:w-auto bg-[#2563EB] text-white px-8 py-3.5 rounded-xl font-bold text-sm shadow-md hover:bg-blue-700 transition flex items-center justify-center gap-2 active:scale-95">
                           <span>📤</span> Kirim Permintaan
                         </button>
                       </div>
                     </div>
                   </div>

                 </div>
               </div>
             </template>

             <!-- View: Menunggu Konfirmasi & Booking Dikonfirmasi -->
             <template v-else-if="cariTutorView === 'menunggu_konfirmasi' || cariTutorView === 'booking_dikonfirmasi'">
               <div>
                 <button @click="cariTutorView = 'booking_tutor'" class="bg-white border border-gray-200 text-gray-700 px-5 py-2.5 rounded-xl font-bold text-sm flex items-center gap-2 hover:bg-gray-50 transition shadow-sm mb-6 w-fit">
                   <span aria-hidden="true">←</span> Kembali
                 </button>
                 
                 <div class="flex justify-between items-center mb-6">
                   <h2 class="text-3xl font-black text-gray-900">Booking Saya</h2>
                   <!-- DUMMY BUTTON FOR TESTING -->
                   <button v-if="cariTutorView === 'menunggu_konfirmasi'" @click="cariTutorView = 'booking_dikonfirmasi'" class="text-xs bg-gray-100 text-gray-500 px-3 py-1.5 rounded-lg hover:bg-gray-200">
                     [Simulasi: Tutor Terima]
                   </button>
                 </div>
                 
                 <div class="bg-white rounded-[32px] border border-gray-100 shadow-sm overflow-hidden">
                   
                   <!-- Status Banner -->
                   <div v-if="cariTutorView === 'menunggu_konfirmasi'" class="bg-amber-50 border-b border-amber-100 px-8 py-6">
                     <h3 class="font-bold text-gray-900 mb-1">Menunggu Konfirmasi Tutor</h3>
                     <p class="text-xs font-medium text-gray-500">Tunggu konfirmasi dalam waktu 24 jam dari tutor</p>
                   </div>
                   <div v-else class="bg-green-50 border-b border-green-100 px-8 py-6 flex flex-col sm:flex-row justify-between sm:items-center gap-4">
                     <div>
                       <h3 class="text-xl font-black text-gray-900 mb-1">Booking Dikonfirmasi</h3>
                       <p class="text-sm font-medium text-gray-600">Mulai les pada Senin, 16 Mei 2026</p>
                     </div>
                     <button class="bg-[#2563EB] text-white px-6 py-3 rounded-xl font-bold text-sm shadow-md hover:bg-blue-700 transition flex items-center justify-center gap-2">
                       <span>📥</span> Bayar Sekarang
                     </button>
                   </div>

                   <!-- Tutor Detail -->
                   <div class="p-8">
                     <div class="flex flex-col sm:flex-row gap-6 items-center sm:items-start">
                       <div class="w-32 h-32 rounded-full overflow-hidden shrink-0 border-4 border-gray-50 shadow-sm">
                         <img src="https://ui-avatars.com/api/?name=Isyana+Randini&background=f3f4f6&color=374151&size=200" class="w-full h-full object-cover">
                       </div>
                       <div class="flex-1 space-y-3 w-full">
                         <div>
                           <h3 class="text-2xl font-black text-gray-900 leading-tight mb-1">Isyana Randini</h3>
                           <div class="flex items-center gap-1 text-sm font-bold text-gray-600 mb-2">
                             <span class="text-[#FACC15] tracking-tighter">★★★★★</span>
                           </div>
                           <p class="text-xs font-bold text-gray-500 flex items-center gap-2"><span class="text-lg">📍</span> Denpasar Selatan</p>
                         </div>
                         
                         <div class="space-y-1.5 pt-2">
                           <p class="text-xs font-bold text-gray-600 flex items-center gap-2"><span class="text-gray-400">📦</span> Paket: 4x Pertemuan</p>
                           <p class="text-xs font-bold text-gray-600 flex items-center gap-2"><span class="text-gray-400">🏠</span> Metode: Privat ke rumah</p>
                         </div>
                         
                         <!-- Active Status Indicator -->
                         <div v-if="cariTutorView === 'booking_dikonfirmasi'" class="inline-flex items-center gap-1.5 bg-[#10B981] text-white px-3 py-1.5 rounded-lg text-xs font-bold shadow-sm mt-2">
                           <span>✓</span> Telah Diterima
                         </div>
                       </div>
                       
                       <div v-if="cariTutorView === 'booking_dikonfirmasi'" class="w-full sm:w-auto self-end sm:self-auto mt-4 sm:mt-0">
                         <button class="w-full sm:w-auto bg-white border border-[#2563EB] text-[#2563EB] px-8 py-3 rounded-xl font-bold text-sm shadow-sm hover:bg-blue-50 transition">
                           Chat Tutor
                         </button>
                       </div>
                     </div>

                     <div v-if="cariTutorView === 'menunggu_konfirmasi'" class="mt-8 space-y-4">
                       <div class="bg-orange-50 border border-orange-100 text-orange-600 text-xs font-bold px-4 py-3 rounded-xl flex items-center gap-2">
                         <span>🕒</span> Status: Menunggu Konfirmasi
                       </div>
                       <div class="flex flex-col sm:flex-row gap-4">
                         <button class="flex-1 bg-white border border-[#2563EB] text-[#2563EB] py-3.5 rounded-xl font-bold text-sm shadow-sm hover:bg-blue-50 transition">
                           Chat Tutor
                         </button>
                         <button class="flex-1 bg-white border border-red-200 text-red-500 py-3.5 rounded-xl font-bold text-sm shadow-sm hover:bg-red-50 transition">
                           Batalkan Permintaan
                         </button>
                       </div>
                     </div>
                   </div>

                 </div>
               </div>
             </template>
          </div>
</template>


<script setup>
import { Head, Link } from '@inertiajs/vue3';
import { ref, computed } from 'vue';

const emit = defineEmits(['navigate']);
const goNav = (id) => emit('navigate', id);

const cariTutorView = ref('semua'); // 'semua', 'terdekat', 'detail_profil', 'detail_lokasi', 'booking_tutor', 'menunggu_konfirmasi', 'booking_dikonfirmasi'
const tutorCategoryFilter = ref('Semua');

const selectedBookingMethod = ref('');
const selectedBookingPackage = ref('');

const tutorCategories = ['Semua', 'Fisika', 'Matematika', 'Bahasa Inggris', 'Informatika'];

const tutorList = ref([
  {
    id: 1,
    name: 'Isyana Randini',
    subject: 'Matematika',
    level: 'Tutor SD - SMA',
    rating: 4.7,
    desc: 'Tutor matematika berpengalaman mengajar aljabar, geometri, dan trigonometri. Sabar dan membuat belajar jadi menyenangkan!'
  },
  {
    id: 2,
    name: 'James Nathan',
    subject: 'Matematika',
    level: 'Tutor SD - SMA',
    rating: 4.7,
    desc: 'Tutor matematika berpengalaman mengajar aljabar, geometri, dan trigonometri. Sabar dan membuat belajar jadi menyenangkan!'
  },
  {
    id: 3,
    name: 'John Doe',
    subject: 'Matematika',
    level: 'Tutor SD - SMA',
    rating: 4.7,
    desc: 'Tutor matematika berpengalaman mengajar aljabar, geometri, dan trigonometri. Sabar dan membuat belajar jadi menyenangkan!'
  },
  {
    id: 4,
    name: 'Ananta Aldora',
    subject: 'Matematika',
    level: 'Tutor SD - SMA',
    rating: 4.7,
    desc: 'Tutor matematika berpengalaman mengajar aljabar, geometri, dan trigonometri. Sabar dan membuat belajar jadi menyenangkan!'
  },
  {
    id: 5,
    name: 'Isyana Randini',
    subject: 'Matematika',
    level: 'Tutor SD - SMA',
    rating: 4.7,
    desc: 'Tutor matematika berpengalaman mengajar aljabar, geometri, dan trigonometri. Sabar dan membuat belajar jadi menyenangkan!'
  },
  {
    id: 6,
    name: 'James Nathan',
    subject: 'Matematika',
    level: 'Tutor SD - SMA',
    rating: 4.7,
    desc: 'Tutor matematika berpengalaman mengajar aljabar, geometri, dan trigonometri. Sabar dan membuat belajar jadi menyenangkan!'
  },
  {
    id: 7,
    name: 'John Doe',
    subject: 'Matematika',
    level: 'Tutor SD - SMA',
    rating: 4.7,
    desc: 'Tutor matematika berpengalaman mengajar aljabar, geometri, dan trigonometri. Sabar dan membuat belajar jadi menyenangkan!'
  },
  {
    id: 8,
    name: 'Ananta Aldora',
    subject: 'Matematika',
    level: 'Tutor SD - SMA',
    rating: 4.7,
    desc: 'Tutor matematika berpengalaman mengajar aljabar, geometri, dan trigonometri. Sabar dan membuat belajar jadi menyenangkan!'
  }
]);

const tutorTerdekatList = ref([
  { id: 1, name: 'Isyana Randini', rating: 4.7, distance: '300m' },
  { id: 2, name: 'Isyana Randini', rating: 4.7, distance: '1.1km' }, // Mocking the exact names in the image
  { id: 3, name: 'Iqbal Mustofa', rating: 4.7, distance: '350m' },
  { id: 4, name: 'Iqbal Mustofa', rating: 4.7, distance: '1.3km' },
  { id: 5, name: 'Tania Riana', rating: 4.7, distance: '400m' },
  { id: 6, name: 'Tania Riana', rating: 4.7, distance: '1.5km' }
]);

</script>
