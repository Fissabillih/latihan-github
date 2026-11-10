<x-layouts.app title="Daftar Poli">

    <div class="flex items-center justify-center px-4">
        <div class="w-full max-w-3xl">
            <div class="card bg-base-100 shadow">
                <div class="card-body">

                    <h2 class="text-2xl font-bold text-center mb-6">
                        🏥 Pendaftaran Poli
                    </h2>

                    {{-- Toast Success --}}
                    @if (session('message'))
                    <div id="toastSuccess" class="toast toast-top toast-end z-50">
                        <div class="alert alert-success shadow-lg">
                            <span> {{ session('message') }}</span>
                        </div>
                    </div>
                    @endif

                    {{-- Error --}}
                    @if ($errors->any())
                    <div class="alert alert-error mb-4">
                        <ul class="list-disc pl-5">
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    <form action="{{ route('pasien.daftar.submit') }}" method="POST">
                        @csrf
                        <input type="hidden" name="id_pasien" value="{{ $user->id }}">

                        {{-- Nomor RM --}}
                        <div class="mb-4">
                            <label class="font-semibold block mb-1">
                                Nomor Rekam Medis
                            </label>

                            <input type="text" value="{{ $user->no_rm }}"
                                class="w-full border-2 rounded-lg p-2 bg-gray-100" disabled>
                        </div>

                        {{-- Pilih Poli --}}
                        <div class="mb-4">
                            <label class="font-semibold block mb-1">
                                Pilih Poli
                            </label>

                            <select name="id_poli" id="poliSelect" class="w-full border-2 rounded-lg p-2">
                                <option value="">-- Pilih Poli --</option>
                                @foreach ($polis as $poli)
                                <option value="{{ $poli->id }}">
                                    {{ $poli->nama_poli }}
                                </option>
                                @endforeach
                            </select>

                        </div>

                        {{-- Pilih Jadwal --}}
                        <div class="mb-4">
                            <label class="font-semibold block mb-1">
                                Pilih Jadwal Periksa
                            </label>

                            <select name="id_jadwal" id="jadwalSelect" class="w-full border-2 rounded-lg p-2">
                                <option value="">-- Pilih Jadwal --</option>

                                @foreach ($jadwals as $jadwal)
                                <option value="{{ $jadwal->id }}" data-poli="{{ $jadwal->dokter->id_poli }}">
                                    {{ $jadwal->hari }}
                                    {{ $jadwal->jam_mulai }} - {{ $jadwal->jam_selesai }}
                                    Dr. {{ $jadwal->dokter->nama ?? '--' }}
                                </option>
                                @endforeach

                            </select>
                        </div>

                        {{-- Keluhan --}}
                        <div class="mb-6">
                            <label class="font-semibold block mb-1">
                                Keluhan
                            </label>
                            <textarea name="keluhan" rows="3" class="w-full border-2 rounded-lg p-2"
                                placeholder="Tulis keluhan anda..."></textarea>
                        </div>

                        <div class="flex justify-end">
                            <button type="submit"
                                class="px-8 py-2 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg transition">
                                Daftar Poli
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", function(){

    const poliSelect = document.getElementById("poliSelect")
    const jadwalSelect = document.getElementById("jadwalSelect")
    const semuaJadwal = Array.from(jadwalSelect.options)
        .slice(1)
        .map(option => option.cloneNode(true))

    poliSelect.addEventListener("change", function() {
        const idPoli = this.value
        const idJadwalTerpilih = jadwalSelect.value
        const jadwalTersedia = idPoli
            ? semuaJadwal.filter(option => option.dataset.poli === idPoli)
            : semuaJadwal

        jadwalSelect.replaceChildren()

        const placeholder = document.createElement("option")
        placeholder.value = ""
        placeholder.textContent = idPoli && jadwalTersedia.length === 0
            ? "-- Tidak ada jadwal tersedia --"
            : "-- Pilih Jadwal --"
        jadwalSelect.appendChild(placeholder)

        jadwalTersedia.forEach(option => {
            jadwalSelect.appendChild(option.cloneNode(true))
        })

        if (jadwalTersedia.some(option => option.value === idJadwalTerpilih)) {
            jadwalSelect.value = idJadwalTerpilih
        }
    })
        })
    </script>
    @endpush
</x-layouts.app>