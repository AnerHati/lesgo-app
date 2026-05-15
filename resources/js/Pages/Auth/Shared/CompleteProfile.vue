<script setup>
import { Link, useForm, usePage } from '@inertiajs/vue3'
import LesGoButton from '@/Components/LesGoButton.vue'
import LesGoInput from '@/Components/LesGoInput.vue'
import { computed } from 'vue'

const user = usePage().props.auth.user;
const role = user.active_role;

const form = useForm({
    phone: '',
    address: '',
});

const submit = () => {
    form.post(route('register.step2.store'));
};

const theme = computed(() => {
    if (role === 'tutor') return { color: 'text-[#FACC15]', bg: 'bg-[#FACC15]', ring: 'ring-yellow-50', border: 'focus:ring-yellow-400' };
    if (role === 'orangtua') return { color: 'text-green-600', bg: 'bg-green-600', ring: 'ring-green-50', border: 'focus:ring-green-500' };
    return { color: 'text-blue-600', bg: 'bg-blue-600', ring: 'ring-blue-50', border: 'focus:ring-blue-500' };
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
                
                <div class="w-full md:w-3/5 p-12 lg:p-16 flex flex-col justify-center z-10">
                    
                    <!-- Progress Stepper -->
                    <div class="flex items-center justify-center space-x-12 mb-12">
                        <div class="flex flex-col items-center">
                            <div class="w-8 h-8 rounded-full text-white flex items-center justify-center text-sm font-bold shadow-md" :class="theme.bg">1</div>
                            <span class="text-[10px] mt-2 font-bold text-gray-400 uppercase tracking-wider">Buat Akun</span>
                        </div>
                        <div class="w-12 h-0.5 -mt-6" :class="user.registration_step >= 1 ? theme.bg : 'bg-gray-100'"></div>
                        <div class="flex flex-col items-center">
                            <div class="w-8 h-8 rounded-full text-white flex items-center justify-center text-sm font-bold shadow-md" :class="[theme.bg, theme.ring, 'ring-4']">2</div>
                            <span class="text-[10px] mt-2 font-bold uppercase tracking-wider" :class="theme.color">Lengkapi Profil</span>
                        </div>
                        <div class="w-12 h-0.5 bg-gray-100 -mt-6"></div>
                        <div class="flex flex-col items-center">
                            <div class="w-8 h-8 rounded-full bg-gray-100 text-gray-400 flex items-center justify-center text-sm font-bold">3</div>
                            <span class="text-[10px] mt-2 font-bold text-gray-300 uppercase tracking-wider">Verifikasi</span>
                        </div>
                    </div>

                    <h1 class="text-4xl font-extrabold text-gray-900 mb-2">
                        Lengkapi <span :class="theme.color">Profil</span> Anda
                    </h1>
                    <p class="text-gray-400 font-medium text-sm mb-10">
                        Selamat bergabung sebagai <span class="font-bold text-gray-600 capitalize">{{ role }}</span>! Yuk lengkapi datamu.
                    </p>

                    <form @submit.prevent="submit" class="space-y-6">
                        <LesGoInput
                            label="Nomor WhatsApp"
                            type="tel"
                            v-model="form.phone"
                            placeholder="0812xxxxxxx"
                            :error="form.errors.phone"
                            required
                        />

                        <div>
                            <label class="block text-sm font-bold text-gray-800 mb-2">Alamat Lengkap <span class="text-red-500">*</span></label>
                            <textarea 
                                v-model="form.address"
                                class="w-full px-4 py-3.5 bg-white border border-gray-200 rounded-xl text-sm outline-none placeholder-gray-400 transition-all min-h-[120px]"
                                :class="theme.border"
                                placeholder="Jl. Anggrek No. 12, Jakarta"
                                required
                            ></textarea>
                            <p v-if="form.errors.address" class="mt-1 text-xs text-red-500">{{ form.errors.address }}</p>
                        </div>

                        <div class="pt-4">
                            <LesGoButton 
                                :variant="role === 'tutor' ? 'warning' : (role === 'orangtua' ? 'secondary' : 'primary')" 
                                class="w-full py-4" 
                                :processing="form.processing"
                            >
                                Lanjutkan ke Verifikasi
                            </LesGoButton>
                        </div>
                    </form>
                </div>

                <div class="hidden md:flex w-2/5 relative items-center justify-center bg-gray-50/50">
                    <div class="relative z-10 flex flex-col items-center text-center p-8">
                         <div class="text-9xl mb-8">🏠📱✨</div>
                        <h3 class="text-2xl font-bold text-gray-800 mb-2">Data Aman</h3>
                        <p class="text-sm text-gray-400 font-medium leading-relaxed">
                            Informasi Anda akan dijaga kerahasiaannya<br>dan hanya digunakan untuk keperluan layanan.
                        </p>
                    </div>
                </div>

            </div>
        </div>
    </div>
</template>
