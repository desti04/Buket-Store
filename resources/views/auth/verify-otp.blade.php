<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Verifikasi Email</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-[#fdf7f9] min-h-screen flex items-center justify-center p-4">
  <div class="w-full max-w-sm bg-white rounded-2xl shadow px-8 py-9">
    <h2 class="text-2xl font-semibold text-center mb-6 text-[#b96b86]">Verifikasi Email</h2>

    @if (session('status'))
      <div class="mb-4 p-3 bg-green-50 border-l-4 border-green-500 text-green-700 text-sm rounded">
        {{ session('status') }}
      </div>
    @endif

    @if ($errors->any())
      <div class="mb-4 p-3 bg-red-50 border-l-4 border-red-500 text-red-700 text-sm rounded">
        @foreach ($errors->all() as $error) <p>{{ $error }}</p> @endforeach
      </div>
    @endif

    <form method="POST" action="{{ route('verify.post') }}">
      @csrf
      <input type="hidden" name="email" value="{{ $email }}">
      <label class="block mb-2 text-sm font-medium text-gray-700">Kode OTP</label>
      <input type="text" name="otp" maxlength="6" required
             class="w-full px-4 py-2 mb-4 border border-[#e2d4da] rounded-md text-sm focus:outline-none focus:ring-2 focus:ring-[#d18aa0]"
             placeholder="6 digit">
      <button type="submit"
              class="w-full py-2.5 rounded-md font-semibold text-sm text-white bg-[#d48fa4] hover:bg-[#c67990] transition-colors">
        Verifikasi
      </button>
    </form>

    <form method="POST" action="{{ route('verify.resend') }}" class="mt-4 text-center">
      @csrf
      <input type="hidden" name="email" value="{{ $email }}">
      <button type="submit" class="text-sm text-[#a154ae] hover:text-[#8b3f97]">
        Kirim ulang kode
      </button>
    </form>
  </div>
</body>
</html>
