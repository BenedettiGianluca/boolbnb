@extends('layouts.app')

@section('content')

@if (\Session::has('message'))
    <div class="container">
        <h2>{!! \Session::get('message') !!}</h2>
    </div>
@endif
<div class="container">
    <div class="d-flex flex-column flex-lg-row">
        <a class="d-lg-none mt-3 mt-lg-0" href="{{ route('admin.apartments.create') }}">
            <button type="button" class="btn plusBtnMobile m-1 text-white">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 448 512">
                <path d="M432 256c0 17.69-14.33 32.01-32 32.01H256v144c0 17.69-14.33 31.99-32 31.99s-32-14.3-32-31.99v-144H48c-17.67 0-32-14.32-32-32.01s14.33-31.99 32-31.99H192v-144c0-17.69 14.33-32.01 32-32.01s32 14.32 32 32.01v144h144C417.7 224 432 238.3 432 256z"/></svg>  
            </button>
        </a>

        <a href="{{route('admin.home')}}">
            <button type="button" class="btn ms_backBtn m-1 text-white">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 256 512">
                <path d="M192 448c-8.188 0-16.38-3.125-22.62-9.375l-160-160c-12.5-12.5-12.5-32.75 0-45.25l160-160c12.5-12.5 32.75-12.5 45.25 0s12.5 32.75 0 45.25L77.25 256l137.4 137.4c12.5 12.5 12.5 32.75 0 45.25C208.4 444.9 200.2 448 192 448z"/></svg>
                Torna alla tua Dashboard  
            </button>
        </a>
    
        <a class="d-none d-lg-block" href="{{ route('admin.apartments.create') }}">
            <button type="button" class="btn addBtn m-1 text-white">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 448 512">
                <path d="M432 256c0 17.69-14.33 32.01-32 32.01H256v144c0 17.69-14.33 31.99-32 31.99s-32-14.3-32-31.99v-144H48c-17.67 0-32-14.32-32-32.01s14.33-31.99 32-31.99H192v-144c0-17.69 14.33-32.01 32-32.01s32 14.32 32 32.01v144h144C417.7 224 432 238.3 432 256z"/></svg>
                Aggiungi appartamento
            </button>
        </a>
    </div>

    <div class="apartmentscontainer">
        @foreach ($apartments as $apartment)
            <div class="card">
                @if (Auth::user()->id == $apartment->user_id)
                <div class="textContainer">

                    <tr>
                        <th scope="row"></td>
                        <td><h3>{{ $apartment->name }}</h3></td>
                        @forelse ($apartment->images as $image)
                            @if ($image->main_image)
                            <div class="w-100 imgContainer">
                                <img class="w-100" src="{{asset( 'storage/'.$image->url )}}" alt="">
                            </div>
                            @endif
                        @empty
                            <td class="w-100">
                                -
                            </td>
                        @endforelse
                        <div class="textContainer">
                            <h6>
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 512 512">
                                <path d="M495.9 132.2C505.8 137.9 512 148.5 512 160V480C512 497.7 497.7 512 480 512C462.3 512 448 497.7 448 480V178.6L256 68.86L64 178.6V480C64 497.7 49.67 512 32 512C14.33 512 0 497.7 0 480V160C0 148.5 6.153 137.9 16.12 132.2L240.1 4.216C249.1-1.405 262-1.405 271.9 4.216L495.9 132.2zM216 168C216 145.9 233.9 128 256 128C278.1 128 296 145.9 296 168C296 190.1 278.1 208 256 208C233.9 208 216 190.1 216 168zM224 512C210.7 512 200 501.3 200 488V313.5L173.1 363.4C166.8 375 152.3 379.4 140.6 373.1C128.1 366.8 124.6 352.3 130.9 340.6L168.7 270.3C184.1 241.8 213.9 223.1 246.2 223.1H265.8C298.1 223.1 327.9 241.8 343.3 270.3L381.1 340.6C387.4 352.3 383 366.8 371.4 373.1C359.7 379.4 345.2 375 338.9 363.4L312 313.5V488C312 501.3 301.3 512 288 512C274.7 512 264 501.3 264 488V400H248V488C248 501.3 237.3 512 224 512V512z"/></svg>
                                <span class="ml-2"><strong>Numero di stanze:</strong></span> 
                                {{ $apartment->rooms }}
                            </h6>
                            <h6>
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 640 512">
                                <path d="M96 318.3v1.689h1.689C97.12 319.4 96.56 318.9 96 318.3zM176 320c44.13 0 80-35.88 80-79.1s-35.88-79.1-80-79.1S96 195.9 96 240S131.9 320 176 320zM256 318.3C255.4 318.9 254.9 319.4 254.3 320H256V318.3zM544 160h-82.1L450.7 183.9C441.5 203.2 421.8 215.8 400 216c-21.23 0-40.97-12.31-50.3-31.35l-12.08-24.64H304c-8.836 0-16 7.161-16 15.1v175.1L64 352V80.01c0-8.834-7.164-15.1-16-15.1h-32c-8.836 0-16 7.163-16 15.1V496C0 504.8 7.164 512 16 512h32C56.84 512 64 504.8 64 496v-47.1h512V496c0 8.836 7.164 16 16 16h32c8.836 0 16-7.164 16-16V256C640 202.1 597 160 544 160zM624 48.01h-115.2l-24.88-37.31c-2.324-3.48-5.539-6.131-9.158-7.977c-1.172-.6016-2.486-.5508-3.738-.9512C468.8 1.035 466.5 0 464.1 0c-.625 0-1.25 .0254-1.875 .0781c-8.625 .6406-16.25 5.876-19.94 13.7l-42.72 90.81l-21.12-43.12c-4.027-8.223-12.39-13.44-21.54-13.44L208 48.02C199.2 48.01 192 55.18 192 64.02v15.99c0 8.836 7.163 15.1 15.1 16l133.1 .0091l36.46 74.55C382.5 178.8 390.8 184 400 184c9.219-.0781 17.78-5.438 21.72-13.78l45.91-97.52l8.406 12.62C480.5 91.1 487.1 96.01 496 96.01h128c8.836 0 16-7.164 16-16V64.01C640 55.18 632.8 48.01 624 48.01z"/></svg>
                                <span class="ml-2"><strong>Numero di letti:</strong></span>
                                {{ $apartment->beds }}
                            </h6>
                            <h6>
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 448 512">
                                <path d="M432 48C440.8 48 448 40.75 448 32V16C448 7.25 440.8 0 432 0h-416C7.25 0 0 7.25 0 16V32c0 8.75 7.25 16 16 16H32v158.7C11.82 221.2 0 237.1 0 256c0 60.98 33.28 115.2 84.1 150.4l-19.59 64.36C59.16 491.3 74.53 512 96.03 512h255.9c21.5 0 36.88-20.75 30.62-41.25L363 406.4C414.7 371.2 448 316.1 448 256c0-18.04-11.82-34.85-32-49.26V48H432zM96 72C96 67.63 99.63 64 104 64h48C156.4 64 160 67.63 160 72v16C160 92.38 156.4 96 152 96h-48C99.63 96 96 92.38 96 88V72zM224 288C135.6 288 64 273.7 64 256c0-17.67 71.63-32 160-32s160 14.33 160 32C384 273.7 312.4 288 224 288z"/></svg>
                                <span class="ml-2"><strong>Numero di bagni:</strong></span>
                                {{ $apartment->bathrooms }}
                            </h6>
                            <h6>
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 448 512">
                                <path d="M416 32C433.7 32 448 46.33 448 64V128C448 145.7 433.7 160 416 160V352C433.7 352 448 366.3 448 384V448C448 465.7 433.7 480 416 480H352C334.3 480 320 465.7 320 448H128C128 465.7 113.7 480 96 480H32C14.33 480 0 465.7 0 448V384C0 366.3 14.33 352 32 352V160C14.33 160 0 145.7 0 128V64C0 46.33 14.33 32 32 32H96C113.7 32 128 46.33 128 64H320C320 46.33 334.3 32 352 32H416zM368 80V112H400V80H368zM96 160V352C113.7 352 128 366.3 128 384H320C320 366.3 334.3 352 352 352V160C334.3 160 320 145.7 320 128H128C128 145.7 113.7 160 96 160zM48 400V432H80V400H48zM400 432V400H368V432H400zM80 112V80H48V112H80z"/></svg>
                                <span class="ml-2"><strong>Metri quadrati:</strong></span>
                                {{ $apartment->square_meters }}
                            </h6>
                            <h6 class="d-flex">
                                <span class="mr-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 384 512">
                                    <path d="M168.3 499.2C116.1 435 0 279.4 0 192C0 85.96 85.96 0 192 0C298 0 384 85.96 384 192C384 279.4 267 435 215.7 499.2C203.4 514.5 180.6 514.5 168.3 499.2H168.3zM192 256C227.3 256 256 227.3 256 192C256 156.7 227.3 128 192 128C156.7 128 128 156.7 128 192C128 227.3 156.7 256 192 256z"/></svg>
                                </span>
                                <span>
                                    <strong>Indirizzo:</strong>
                                    
                                    <span>{{ $apartment->address }}</span>
                                </span>
                            </h6>
                        </div>

                        <td>
                            <a href="{{ route('admin.apartments.show', $apartment->id) }}">
                                <button type="button" class="btn showbtn my-1 text-white">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 576 512">
                                    <path d="M279.6 160.4C282.4 160.1 285.2 160 288 160C341 160 384 202.1 384 256C384 309 341 352 288 352C234.1 352 192 309 192 256C192 253.2 192.1 250.4 192.4 247.6C201.7 252.1 212.5 256 224 256C259.3 256 288 227.3 288 192C288 180.5 284.1 169.7 279.6 160.4zM480.6 112.6C527.4 156 558.7 207.1 573.5 243.7C576.8 251.6 576.8 260.4 573.5 268.3C558.7 304 527.4 355.1 480.6 399.4C433.5 443.2 368.8 480 288 480C207.2 480 142.5 443.2 95.42 399.4C48.62 355.1 17.34 304 2.461 268.3C-.8205 260.4-.8205 251.6 2.461 243.7C17.34 207.1 48.62 156 95.42 112.6C142.5 68.84 207.2 32 288 32C368.8 32 433.5 68.84 480.6 112.6V112.6zM288 112C208.5 112 144 176.5 144 256C144 335.5 208.5 400 288 400C367.5 400 432 335.5 432 256C432 176.5 367.5 112 288 112z"/></svg>
                                    Mostra
                                </button>
                            </a>

                            <a href="{{ route('admin.apartments.edit', $apartment->id) }}">
                                <button type="button" class="btn editbtn my-1 text-white">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 512 512">
                                    <path d="M490.3 40.4C512.2 62.27 512.2 97.73 490.3 119.6L460.3 149.7L362.3 51.72L392.4 21.66C414.3-.2135 449.7-.2135 471.6 21.66L490.3 40.4zM172.4 241.7L339.7 74.34L437.7 172.3L270.3 339.6C264.2 345.8 256.7 350.4 248.4 353.2L159.6 382.8C150.1 385.6 141.5 383.4 135 376.1C128.6 370.5 126.4 361 129.2 352.4L158.8 263.6C161.6 255.3 166.2 247.8 172.4 241.7V241.7zM192 63.1C209.7 63.1 224 78.33 224 95.1C224 113.7 209.7 127.1 192 127.1H96C78.33 127.1 64 142.3 64 159.1V416C64 433.7 78.33 448 96 448H352C369.7 448 384 433.7 384 416V319.1C384 302.3 398.3 287.1 416 287.1C433.7 287.1 448 302.3 448 319.1V416C448 469 405 512 352 512H96C42.98 512 0 469 0 416V159.1C0 106.1 42.98 63.1 96 63.1H192z"/></svg>
                                    Modifica
                                </button>
                            </a>

                            <a href="{{ route('admin.apartmentMessages', $apartment->id) }}">
                                <button type="button" class="btn messagebtn my-1 text-white">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 512 512">
                                    <path d="M144 208c-17.7 0-32 14.3-32 32s14.3 32 32 32 32-14.3 32-32-14.3-32-32-32zm112 0c-17.7 0-32 14.3-32 32s14.3 32 32 32 32-14.3 32-32-14.3-32-32-32zm112 0c-17.7 0-32 14.3-32 32s14.3 32 32 32 32-14.3 32-32-14.3-32-32-32zM256 32C114.6 32 0 125.1 0 240c0 47.6 19.9 91.2 52.9 126.3C38 405.7 7 439.1 6.5 439.5c-6.6 7-8.4 17.2-4.6 26S14.4 480 24 480c61.5 0 110-25.7 139.1-46.3C192 442.8 223.2 448 256 448c141.4 0 256-93.1 256-208S397.4 32 256 32zm0 368c-26.7 0-53.1-4.1-78.4-12.1l-22.7-7.2-19.5 13.8c-14.3 10.1-33.9 21.4-57.5 29 7.3-12.1 14.4-25.7 19.9-40.2l10.6-28.1-20.6-21.8C69.7 314.1 48 282.2 48 240c0-88.2 93.3-160 208-160s208 71.8 208 160-93.3 160-208 160z"/></svg>
                                    Messaggi
                                </button>
                            </a>

                            <a href="{{ route('admin.images.edit', $apartment->id) }}">
                                <button type="button" class="btn imagebtn my-1 text-white">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" viewBox="0 0 576 512">
                                <path d="M480 416v16c0 26.51-21.49 48-48 48H48c-26.51 0-48-21.49-48-48V176c0-26.51 21.49-48 48-48h16v208c0 44.112 35.888 80 80 80h336zm96-80V80c0-26.51-21.49-48-48-48H144c-26.51 0-48 21.49-48 48v256c0 26.51 21.49 48 48 48h384c26.51 0 48-21.49 48-48zM256 128c0 26.51-21.49 48-48 48s-48-21.49-48-48 21.49-48 48-48 48 21.49 48 48zm-96 144l55.515-55.515c4.686-4.686 12.284-4.686 16.971 0L272 256l135.515-135.515c4.686-4.686 12.284-4.686 16.971 0L512 208v112H160v-48z"/></svg>
                                    Gestione immagini
                                </button>
                            </a>

                            @if(count($apartment->active_sponsorships)<=0)
                            <a href="{{ route('admin.sponsorize', $apartment->id) }}">
                                <button type="button" class="btn sponsorbtn my-1 text-white">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 576 512">
                                <path d="M527.9 32H48.1C21.5 32 0 53.5 0 80v352c0 26.5 21.5 48 48.1 48h479.8c26.6 0 48.1-21.5 48.1-48V80c0-26.5-21.5-48-48.1-48zM54.1 80h467.8c3.3 0 6 2.7 6 6v42H48.1V86c0-3.3 2.7-6 6-6zm467.8 352H54.1c-3.3 0-6-2.7-6-6V256h479.8v170c0 3.3-2.7 6-6 6zM192 332v40c0 6.6-5.4 12-12 12h-72c-6.6 0-12-5.4-12-12v-40c0-6.6 5.4-12 12-12h72c6.6 0 12 5.4 12 12zm192 0v40c0 6.6-5.4 12-12 12H236c-6.6 0-12-5.4-12-12v-40c0-6.6 5.4-12 12-12h136c6.6 0 12 5.4 12 12z"/></svg>
                                    Sponsorizza
                                </button>
                            </a>
                            @else
                            <a href="{{ route('admin.sponsorize', $apartment->id) }}">
                                <button type="button" class="btn sponsorizzatobtn my-1 text-white">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#ffff55" viewBox="0 0 576 512">
                                <path d="M527.9 32H48.1C21.5 32 0 53.5 0 80v352c0 26.5 21.5 48 48.1 48h479.8c26.6 0 48.1-21.5 48.1-48V80c0-26.5-21.5-48-48.1-48zM54.1 80h467.8c3.3 0 6 2.7 6 6v42H48.1V86c0-3.3 2.7-6 6-6zm467.8 352H54.1c-3.3 0-6-2.7-6-6V256h479.8v170c0 3.3-2.7 6-6 6zM192 332v40c0 6.6-5.4 12-12 12h-72c-6.6 0-12-5.4-12-12v-40c0-6.6 5.4-12 12-12h72c6.6 0 12 5.4 12 12zm192 0v40c0 6.6-5.4 12-12 12H236c-6.6 0-12-5.4-12-12v-40c0-6.6 5.4-12 12-12h136c6.6 0 12 5.4 12 12z"/></svg>
                                    Sponsorizzato
                                </button>
                            </a>
                            @endif
                            <div class="d-flex justify-content-center">
                                <button data-toggle="modal" data-target="#modal-delete-{{$apartment->id}}" type="button" class="btn cancelbtn p-2 text-white my-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#ffaaaa" viewBox="0 0 320 512">
                                    <path d="M310.6 361.4c12.5 12.5 12.5 32.75 0 45.25C304.4 412.9 296.2 416 288 416s-16.38-3.125-22.62-9.375L160 301.3L54.63 406.6C48.38 412.9 40.19 416 32 416S15.63 412.9 9.375 406.6c-12.5-12.5-12.5-32.75 0-45.25l105.4-105.4L9.375 150.6c-12.5-12.5-12.5-32.75 0-45.25s32.75-12.5 45.25 0L160 210.8l105.4-105.4c12.5-12.5 32.75-12.5 45.25 0s12.5 32.75 0 45.25l-105.4 105.4L310.6 361.4z"/></svg>
                                    Elimina
                                </button>
                            </div>
                            <div class="modal fade" id="modal-delete-{{$apartment->id}}" tabindex="-1" role="dialog" aria-labelledby="modal-delete2" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            Sicuro di voler cancellare questo appartamento?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-primary" data-dismiss="modal" aria-label="Close">Annulla</button>
                                            <form  action="{{ route('admin.apartments.destroy', $apartment->id) }}" method="POST">
                                                @csrf
                                                @method("DELETE")
                                                <button  type="submit" class="btn btn-danger m-auto text-white" >
                                                Cancella
                                                </button>                                            
                                            </form>
                                        </div>
                                    </div>
                                </div>     
                            </div>     
                        </td>
                    </tr>
                </div>
                @endif
            </div>
        @endforeach
    </div>
</div>
@endsection

