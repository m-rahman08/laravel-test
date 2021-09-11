
<div>

    @isset($error)
    {{ $error }}
    @endisset

    <form method="POST">
        @csrf
        <input type="text" name="postcodeOne"><br>
        <input type="text" name="postcodeTwo"><br><br>
        <input type="submit">
    </form>

    The distance is {{ $distance }} miles

    <br><br>
    List of postcodes
    @isset($postcodes)
        @foreach ($postcodes as $postcode)
            <p>{{ $postcode->postcode }}</p>
        @endforeach
    @endisset
</div>
