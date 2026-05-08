<template>
  <div class="animate-fade-in space-y-6">
    
    <!-- Row 1: Hero + Notifikasi -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
      
      <!-- Hero Banner -->
      <div class="lg:col-span-8 bg-gradient-to-br from-[#00A3FF] to-[#0066FF] rounded-[24px] p-8 lg:p-10 flex justify-between items-center relative overflow-hidden shadow-lg shadow-blue-500/20 group">
        <!-- Floating Elements/Illustration (Simulating Figma 3D feel) -->
        <div class="absolute -right-4 -bottom-12 w-[380px] h-[380px] opacity-90 transition-transform duration-700 group-hover:scale-110 pointer-events-none z-0">
           <!-- Using a high quality placeholder for the family illustration -->
           <img src="https://cdni.iconscout.com/illustration/premium/thumb/family-studying-together-5621434-4694935.png" class="w-full h-full object-contain drop-shadow-2xl" />
        </div>

         <div class="z-10 max-w-lg">
          <h2 class="text-3xl lg:text-[40px] font-black mb-2 text-white leading-tight">Selamat datang!</h2>
          <p class="text-blue-100 font-bold mb-4 text-lg">Pantau perkembangan {{ childName }} hari ini</p>
          <p class="text-blue-50/80 font-medium mb-10 text-sm max-w-[320px] leading-relaxed">
            Lihat perkembangan {{ childName }} dan jadwal kursusnya hari ini!
          </p>

          
          <button type="button" class="bg-[#2563EB] hover:bg-blue-700 text-white px-8 py-3.5 rounded-2xl font-bold text-sm inline-flex items-center gap-3 transition-all transform hover:scale-105 shadow-lg shadow-blue-900/20">
            <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><path d="M12 20V10M18 20V4M6 20v-4"/></svg>
            Lihat Progres
          </button>
        </div>
      </div>

      <!-- Notifikasi Card -->
      <div class="lg:col-span-4 bg-white rounded-[24px] p-6 border border-gray-100 shadow-sm flex flex-col">
        <div class="flex justify-between items-center mb-8">
          <h3 class="font-black text-gray-800 text-lg flex items-center gap-2">
            <svg class="w-6 h-6 text-gray-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9M13.73 21a2 2 0 0 1-3.46 0"/></svg>
            Notifikasi
          </h3>
          <button class="text-xs text-gray-400 font-bold hover:text-blue-600 transition tracking-wide uppercase">Lihat Semua</button>
        </div>
        
        <div class="space-y-8">
          <div class="flex gap-4 items-start group cursor-pointer">
            <div class="w-14 h-14 bg-cyan-50 text-cyan-500 rounded-2xl flex items-center justify-center shadow-sm group-hover:scale-110 transition-transform">
               <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"></path></svg>
            </div>
            <div class="flex-1">
              <p class="text-[14px] font-black text-gray-800 mb-1">Tugas Baru</p>
              <p class="text-[12px] text-gray-500 leading-tight">Tutor Rian menambahkan tugas baru untuk kamu</p>
              <p class="text-[11px] text-blue-500 font-bold mt-2 text-right">2 menit lalu</p>
            </div>
          </div>
          
          <div class="flex gap-4 items-start group cursor-pointer">
            <div class="w-14 h-14 bg-blue-50 text-blue-500 rounded-2xl flex items-center justify-center shadow-sm group-hover:scale-110 transition-transform">
               <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
            </div>
            <div class="flex-1">
              <p class="text-[14px] font-black text-gray-800 mb-1">Pengumpulan Tugas</p>
              <p class="text-[12px] text-gray-500 leading-tight">Kumpulkan tugas Bahasa Indonesia hari ini!</p>
              <p class="text-[11px] text-blue-500 font-bold mt-2 text-right">2 jam lalu</p>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Row 2: Schedules & Calendar -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
      <!-- Jadwal Kenzo Card -->
     <div class="lg:col-span-4 bg-white rounded-[24px] p-6 border border-gray-100 shadow-sm">
        <div class="flex justify-between items-center mb-8 border-b border-gray-50 pb-4">
          <h3 class="font-black text-gray-800 flex items-center gap-2">
            <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
            Jadwal {{ childName }}
          </h3>
        </div>
        <div class="space-y-6">
          <div v-if="activeClasses.length === 0" class="text-sm text-gray-400 font-medium text-center py-4">Belum ada kelas aktif.</div>
          
          <div v-for="cls in activeClasses" :key="cls.id" class="flex items-center gap-4 hover:translate-x-2 transition-transform cursor-pointer">
            <div class="w-14 h-14 rounded-full border-2 border-white shadow-md overflow-hidden shrink-0">
               <img :src="`https://ui-avatars.com/api/?name=${cls.tutor.name.replace(/ /g, '+')}&background=eff6ff&color=2563eb`" class="w-full h-full object-cover">
            </div>
            <div>
              <p class="text-[14px] font-black text-blue-600 mb-0.5">{{ cls.subject.name }}</p>
              <p class="text-[12px] text-gray-500 font-bold">Tutor {{ cls.tutor.name }}</p>
            </div>
          </div>
        </div>
      </div> 

      <!-- Tugas Anak Card -->
      <div class="lg:col-span-4 bg-white rounded-[24px] p-6 border border-gray-100 shadow-sm">
        <div class="flex justify-between items-center mb-8 border-b border-gray-50 pb-4">
          <h3 class="font-black text-gray-800 flex items-center gap-2">
            <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path></svg>
            Tugas {{ childName }}
          </h3>
        </div>
        <div class="space-y-6">
          <div v-if="recentScores.length === 0" class="text-sm text-gray-400 font-medium text-center py-4">Belum ada tugas yang dikerjakan.</div>

          <div v-for="score in recentScores" :key="score.id" class="flex items-center gap-4 group cursor-pointer">
            <div class="w-14 h-14 rounded-2xl flex items-center justify-center text-3xl shadow-inner transition-transform group-hover:scale-110 bg-blue-50">
              📝
            </div>
            <div class="flex-1">
              <p class="text-[14px] font-black text-blue-600 mb-0.5">Nilai: {{ score.score !== null ? score.score : 'Menunggu' }}</p>
              <p class="text-[12px] text-gray-500 font-bold truncate">Tugas / Kuis ID: {{ score.task_id }}</p>
              <p class="text-[11px] text-gray-400 mt-1 text-right">{{ new Date(score.created_at).toLocaleDateString('id-ID') }}</p>
            </div>
          </div>
        </div>
      </div>

      <!-- Calendar Card -->
      <div class="lg:col-span-4 bg-white rounded-[24px] p-6 border border-gray-100 shadow-sm">
        <div class="flex justify-between items-center mb-8">
          <h3 class="font-black text-gray-800 flex items-center gap-2">
            <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
            Februari 2026
          </h3>
          <div class="flex gap-2">
            <button class="w-8 h-8 border border-gray-100 rounded-xl text-gray-400 hover:bg-gray-50 flex items-center justify-center transition shadow-sm">‹</button>
            <button class="w-8 h-8 border border-gray-100 rounded-xl text-gray-400 hover:bg-gray-50 flex items-center justify-center transition shadow-sm">›</button>
          </div>
        </div>
        
        <div class="grid grid-cols-7 text-center text-[11px] text-gray-400 font-black mb-6 uppercase tracking-widest">
          <span>Sun</span><span>Mon</span><span>Tue</span><span>Wed</span><span>Thu</span><span>Fri</span><span>Sat</span>
        </div>
        
        <div class="grid grid-cols-7 text-center gap-y-4 font-bold text-[13px]">
          <div v-for="n in 6" :key="`e${n}`" class="text-transparent">0</div>
          <div v-for="d in 28" :key="d" class="flex justify-center items-center">
            <div :class="[
              'w-9 h-9 flex items-center justify-center rounded-xl transition cursor-pointer',
              d === 15 ? 'bg-blue-600 text-white shadow-lg shadow-blue-500/30' : 'text-gray-700 hover:bg-gray-50',
              [2, 9, 16, 23].includes(d) ? 'text-red-500' : ''
            ]">
              {{ d }}
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Row 3: Progress Section -->
    <div class="space-y-6">
      <div class="flex justify-between items-center px-2">
        <h3 class="text-[22px] font-black text-gray-800 flex items-center gap-3 uppercase tracking-tight">
          <svg class="w-8 h-8 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
          Progres {{ childName }}
        </h3>
        <button class="text-xs text-gray-400 font-bold hover:text-blue-600 transition uppercase tracking-widest">Lihat Semua</button>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-2 gap-6 lg:gap-8">
        <div v-for="(subject, idx) in [
          { name: 'Matematika', topic: 'Transformasi Geometri', tutor: 'Isyana Randini', schedule: 'Jumat, 15:00-17:30' },
          { name: 'Bahasa Jepang', topic: 'Huruf Hiragana', tutor: 'Renata', schedule: 'Rabu, 12:00-13:30' },
          { name: 'Bahasa Inggris', topic: 'Simple Present Tense', tutor: 'John Doe', schedule: 'Kamis, 17:00-18:30' },
          { name: 'Bahasa Indonesia', topic: 'Paragraf Deduktif', tutor: 'Jonathan', schedule: 'Sabtu, 15:00-17:30' }
        ]" :key="idx" class="bg-white rounded-[24px] p-8 border border-gray-100 shadow-sm hover:shadow-xl transition-all duration-300 flex flex-col group">
          
          <div class="mb-6 flex-1">
             <h4 class="text-[18px] font-black text-blue-600 mb-1">{{ subject.name }}</h4>
             <p class="text-[14px] text-gray-500 font-bold mb-6">{{ subject.topic }}</p>
             
             <div class="space-y-3">
               <div class="flex items-center gap-3 text-gray-500 font-bold text-[12px]">
                 <svg class="w-5 h-5 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                 Tutor {{ subject.tutor }}
               </div>
               <div class="flex items-center gap-3 text-gray-500 font-bold text-[12px]">
                 <svg class="w-5 h-5 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                 {{ subject.schedule }}
               </div>
             </div>
          </div>

          <!-- Progress Bar Block matching Figma 100% -->
          <div class="mt-auto">
            <div class="flex justify-between items-center mb-3">
               <span class="text-[13px] font-black text-blue-600">Progres</span>
               <span class="text-[13px] font-black text-blue-600">2/4</span>
            </div>
            <div class="h-2 w-full bg-gray-100 rounded-full overflow-hidden">
              <div class="h-full bg-blue-600 rounded-full w-1/2 shadow-sm transition-all duration-1000 group-hover:bg-blue-500"></div>
            </div>
          </div>

        </div>
      </div>
    </div>

  </div>
</template>

<script setup>
import { computed } from 'vue';
import { usePage } from '@inertiajs/vue3';

const page = usePage();

const children = computed(() => page.props.children || []);
const activeClasses = computed(() => page.props.activeClasses || []);
const recentScores = computed(() => page.props.recentScores || []);

const activeChild = computed(() => children.value[0]);
const childName = computed(() => activeChild.value ? activeChild.value.name.split(' ')[0] : 'Anak Anda');

const emit = defineEmits(['navigate']);
const goNav = (id) => emit('navigate', id);
</script>

