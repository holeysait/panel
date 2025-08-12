@if(session('status'))
  <div class="alert success">{{ session('status') }}</div>
@endif
@if ($errors->any())
  <div class="alert danger">
    <strong>Ошибка:</strong>
    <ul>
      @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
      @endforeach
    </ul>
  </div>
@endif
