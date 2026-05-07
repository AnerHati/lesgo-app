<script setup>
import { Link, useForm, usePage } from '@inertiajs/vue3'
import LesGoButton from '@/Components/LesGoButton.vue'
import { ref, computed } from 'vue'

const user = usePage().props.auth.user;
const role = user.active_role;

const form = useForm({
    ktp: null,
    ijazah: null,
});

const ktpPreview = ref(null);
const ijazahPreview = ref(null);

const onKtpChange = (e) => {
    const file = e.target.files[0];
    form.ktp = file;
    ktpPreview.value = URL.createObjectURL(file);
};

const onIjazahChange = (e) => {
    const file = e.target.files[0];
    form.ijazah = file;
    ijazahPreview.value = URL.createObjectURL(file);
};

const submit = () => {
    form.post(route('register.step3.store'), {
        forceFormData: true,
    });
};

const theme = computed(() => {
    if (role === 'tutor') return { 
        color: 'text-[#FACC15]', 
        bg: 'bg-[#FACC15]', 
        ring: 'ring-yellow-50', 
        border: 'border-yellow-100',
        label: 'Ijazah Pendidikan Terakhir',
        emoji: '🎓'
    };
    if (role === 'orangtua' || role === 'parent') return { 
        color: 'text-green-600', 
        bg: 'bg-green-600', 
        ring: 'ring-green-50', 
        border: 'border-green-100',
        label: 'Foto Kartu Keluarga (Opsi)',
        emoji: '👪'
    };
    return { 
        color: 'text-blue-600', 
        bg: 'bg-blue-600', 
        ring: 'ring-blue-50', 
        border: 'border-blue-100',
        label: 'Kartu Pelajar / Surat Keterangan',
        emoji: '🎒'
    };
});
</script>

<template>
    <div class="min-h-screen bg-[#F8FAFC] font-sans flex flex-col items-center">
        <nav class="max-w-7xl mx-auto w-full px-8 py-6 flex justify-between items-center bg-transparent">
            <Link href="/" class="flex items-center gap-3">
                <div class="text-green-500 text-3xl">🌱</div>
                <div class="leading-tight">
                    <div class="text-2xl font-extrabold text-[#10B981] tracking-tight">LesGo</div>
                    <div class="text-[10px] text-gray-500 font-medium tracking-wide">Digital Tutoring Ecosystem</div>
                </div>
            </Link>
        </nav>

        <div class="flex-1 w-full flex justify-center items-center p-6 max-w-7xl">
            <div class="bg-white rounded-[40px] shadow-[0_8px_30px_rgb(0,0,0,0.04)] w-full flex flex-col md:flex-row overflow-hidden border border-gray-100 min-h-[600px] relative">
                
                <div class="w-full md:w-3/5 p-10 lg:p-16 flex flex-col">
                    
                    <!-- Progress Stepper -->
                    <div class="flex items-center justify-center space-x-12 mb-12">
                        <div class="flex flex-col items-center">
                            <div class="w-8 h-8 rounded-full text-white flex items-center justify-center text-sm font-bold shadow-md" :class="theme.bg">1</div>
                            <span class="text-[10px] mt-2 font-bold text-gray-400 uppercase tracking-wider">Buat Akun</span>
                        </div>
                        <div class="w-12 h-0.5 -mt-6" :class="theme.bg"></div>
                        <div class="flex flex-col items-center">
                            <div class="w-8 h-8 rounded-full text-white flex items-center justify-center text-sm font-bold shadow-md" :class="theme.bg">2</div>
                            <span class="text-[10px] mt-2 font-bold text-gray-400 uppercase tracking-wider">Lengkapi Profil</span>
                        </div>
                        <div class="w-12 h-0.5 -mt-6" :class="theme.bg"></div>
                        <div class="flex flex-col items-center">
                            <div class="w-8 h-8 rounded-full text-white flex items-center justify-center text-sm font-bold shadow-md ring-4" :class="[theme.bg, theme.ring]">3</div>
                            <span class="text-[10px] mt-2 font-bold uppercase tracking-wider" :class="theme.color">Verifikasi</span>
                        </div>
                    </div>

                    <h1 class="text-4xl font-extrabold text-gray-900 mb-2">
                        Proses <span :class="theme.color">Verifikasi</span> Akun Anda
                    </h1>
                    <p class="text-gray-400 font-medium text-sm mb-10">
                        Unggah foto Identitas dan {{ theme.label.split(' ')[0] }} Anda.
                    </p>

                    <form @submit.prevent="submit" class="space-y-8">
                        <div class="relative">
                            <div 
                                class="w-full border-2 border-dashed rounded-2xl p-8 flex flex-col items-center justify-center transition-all group cursor-pointer overflow-hidden"
                                :class="[theme.border, 'bg-gray-50/30 hover:bg-white']"
                                @click="$refs.ktpInput.click()"
                            >
                                <template v-if="!ktpPreview">
                                    <div class="bg-white p-3 rounded-xl shadow-sm mb-4 group-hover:scale-110 transition-transform">
                                        <svg class="w-8 h-8 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                    </div>
                                    <p class="text-sm text-gray-500 font-medium mb-4">Unggah foto KTP / Kartu Identitas</p>
                                    <div class="text-white px-6 py-2 rounded-xl font-bold text-sm shadow-md" :class="theme.bg">Pilih Foto</div>
                                </template>
                                <img v-else :src="ktpPreview" class="absolute inset-0 w-full h-full object-cover" />
                            </div>
                            <input type="file" ref="ktpInput" class="hidden" @change="onKtpChange" accept="image/*" />
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-gray-800 mb-2">{{ theme.label }} <span class="text-red-500">*</span></label>
                            <div 
                                class="w-full border border-gray-200 rounded-2xl p-4 flex items-center justify-between bg-white hover:border-blue-400 transition-colors cursor-pointer"
                                @click="$refs.ijazahInput.click()"
                            >
                                <div class="flex items-center gap-4">
                                    <div class="bg-gray-50 p-2 rounded-lg">
                                        <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                        </svg>
                                    </div>
                                    <div class="text-left">
                                        <p class="text-sm font-bold text-gray-800">{{ form.ijazah ? form.ijazah.name : 'Unggah foto' }}</p>
                                        <p class="text-[10px] text-gray-400 font-medium">Format JPG, PNG, maks 5mb.</p>
                                    </div>
                                </div>
                                <div :class="theme.color">
                                    <svg v-if="form.ijazah" class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                                </div>
                            </div>
                            <input type="file" ref="ijazahInput" class="hidden" @change="onIjazahChange" accept="image/*" />
                        </div>

                        <div class="pt-6">
                            <LesGoButton 
                                :variant="role === 'tutor' ? 'warning' : (role === 'orangtua' ? 'secondary' : 'primary')" 
                                class="w-full py-4 text-lg" 
                                :processing="form.processing"
                            >
                                Kirim & Selesaikan
                            </LesGoButton>
                        </div>
                    </form>
                </div>

                <div class="hidden md:flex w-2/5 relative items-center justify-center bg-gray-50/30 overflow-hidden">
                    <div class="relative z-10 flex flex-col items-center text-center p-8">
                        <div class="relative mb-8">
                            <span class="text-9xl">{{ theme.emoji }}</span>
                        </div>
                        <h3 class="text-xl font-bold text-gray-800 mb-2">Hampir Selesai!</h3>
                        <p class="text-sm text-gray-400 font-medium leading-relaxed">
                            Verifikasi ini membantu kami menjaga kualitas<br>dan keamanan komunitas LesGo.
                        </p>
                    </div>
                </div>

            </div>
        </div>
    </div>
</template>
