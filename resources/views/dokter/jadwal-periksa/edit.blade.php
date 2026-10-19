<x-layouts.app title="Edit Jadwal Periksa">

    {{-- Header --}}
    <div class="flex items-center gap-3 mb-6">
        <a href="{{ route('jadwal-periksa.index') }}"
            class="flex items-center justify-center w-9 h-9 rounded-lg bg-slate-100 text-slate-500 hover:bg-slate-200 transition">
            <i class="fas fa-arrow-left text-xs"></i>
        </a>
        <h2 class="text-xl font-bold text-slate-800">
            Edit Jadwal Periksa {{-- BEDA: judul --}}
        </h2>
    </div>

    {{-- Card --}}
    <div class="card bg-base-100 shadow-md rounded-2xl border border-slate-200">
        <div class="card-body p-7">

            {{-- BEDA: action ke update + kirim id jadwal --}}
            <form action="{{ route('jadwal-periksa.update', $jadwal->id) }}" method="POST">
                @csrf
                @method('PUT') {{-- BEDA: wajib untuk update --}}

                {{-- Hari --}}
                <div class="form-control mb-5">
                    <label class="label pb-1">
                        <span class="text-sm font-semibold text-gray-700">
                            Hari <span class="text-red-500">*</span>
                        </span>
                    </label>

                    <select name="hari"
                        class="select select-bordered w-full rounded-lg text-sm @error('hari') select-error @enderror"
                        required>
                        <option value="">Pilih Hari</option>
                        @foreach($hariList as $hari)
                        {{-- BEDA: old(..., nilai dari database) --}}
                        <option value="{{ $hari }}" {{ old('hari', $jadwal->hari) === $hari ? 'selected' : '' }}>
                            {{ $hari }}
                        </option>
                        @endforeach
                    </select>

                    @error('hari')
                    <label class="label pt-1">
                        <span class="label-text-alt text-red-500">{{ $message }}</span>
                    </label>
                    @enderror
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5 mb-5">

                    {{-- Jam Mulai --}}
                    <div class="form-control">
                        <label class="label pb-1">
                            <span class="text-sm font-semibold text-gray-700">
                                Jam Mulai <span class="text-red-500">*</span>
                            </span>
                        </label>

                        <input type="time" name="jam_mulai"
                            value="{{ old('jam_mulai', substr($jadwal->jam_mulai, 0, 5)) }}"
                            class="input input-bordered w-full rounded-lg text-sm @error('jam_mulai') input-error @enderror"
                            required>

                        @error('jam_mulai')
                        <label class="label pt-1">
                            <span class="label-text-alt text-red-500">{{ $message }}</span>
                        </label>
                        @enderror
                    </div>

                    {{-- Jam Selesai --}}
                    <div class="form-control">
                        <label class="label pb-1">
                            <span class="text-sm font-semibold text-gray-700">
                                Jam Selesai <span class="text-red-500">*</span>
                            </span>
                        </label>

                        <input type="time" name="jam_selesai"
                            value="{{ old('jam_selesai', substr($jadwal->jam_selesai, 0, 5)) }}"
                            class="input input-bordered w-full rounded-lg text-sm @error('jam_selesai') input-error @enderror"
                            required>

                        @error('jam_selesai')
                        <label class="label pt-1">
                            <span class="label-text-alt text-red-500">{{ $message }}</span>
                        </label>
                        @enderror
                    </div>

                </div>

                {{-- Status (BEDA: hanya ada di edit) --}}
                <div class="form-control mb-6">
                    <label class="label pb-1">
                        <span class="text-sm font-semibold text-gray-700">
                            Status <span class="text-red-500">*</span>
                        </span>
                    </label>

                    <select name="status"
                        class="select select-bordered w-full rounded-lg text-sm @error('status') select-error @enderror"
                        required>
                        <option value="1" {{ (string) old('status', (int) $jadwal->status) === '1' ? 'selected' : '' }}>Aktif</option>
                        <option value="0" {{ (string) old('status', (int) $jadwal->status) === '0' ? 'selected' : '' }}>Tidak Aktif</option>
                    </select>

                    <label class="label pt-1">
                        <span class="label-text-alt text-slate-400">
                            Hanya satu jadwal yang dapat aktif. Mengaktifkan jadwal ini akan menonaktifkan jadwal lainnya.
                        </span>
                    </label>

                    @error('status')
                    <label class="label pt-0">
                        <span class="label-text-alt text-red-500">{{ $message }}</span>
                    </label>
                    @enderror
                </div>

                {{-- Buttons --}}
                <div class="flex gap-3">
                    <button type="submit"
                        class="flex items-center gap-2 px-6 py-2.5 bg-[#2d4499] hover:bg-[#1e2d6b] text-white rounded-lg text-sm font-semibold transition">
                        <i class="fas fa-save"></i>
                        Simpan
                    </button>

                    <a href="{{ route('jadwal-periksa.index') }}"
                        class="flex items-center gap-2 px-6 py-2.5 bg-slate-100 hover:bg-slate-200 text-slate-500 rounded-lg text-sm font-semibold transition">
                        Batal
                    </a>
                </div>

            </form>
        </div>
    </div>

</x-layouts.app>