@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Password Sales</h1>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Password</th>
                </tr>
            </thead>
            <tbody>
                @foreach($sales as $sales)
                <tr>

                    {{-- <td>{{ $sales->name }}</td>
    <td>
        <div class="password-container">
            <span class="password-text">{{ Crypt::decrypt($sales->password) }}</span>
            <button class="copy-button btn" data-password="{{ Crypt::decrypt($sales->password) }}">Copy</button>
        </div>
    </td> --}}


    {{-- @foreach($sales as $sales) --}}
{{-- <tr> --}}
    {{-- <td>{{$sales->email}}</td> --}}
    <td>{{ $sales->name }}</td>
    <td>{{$sales->email}}</td>
    <td>
        <div class="password-container">
            <span class="password-text" data-password="{{ Crypt::decrypt($sales->password) }}">{{ Crypt::decrypt($sales->password) }}</span>
            <button class="copy-button">Copy</button>
        </div>
    </td>
{{-- </tr> --}}
{{-- @endforeach --}}




                    {{-- <td>{{ $sales->name }}</td>
                    <td>
                        <div class="password-container">
                            <span class="password-text">{{ Crypt::decrypt($sales->password) }}</span>
                            <button class="copy-button" data-password="{{ Crypt::decrypt($sales->password) }}">Copy</button>
                        </div>
                    </td>    --}}
                    
                    
                    {{-- <td>{{ Crypt::decrypt($sales->password) }}</td> --}}
                    {{-- <td>&nbsp;</td> --}}
                    {{-- <td> --}}
                    {{-- <button class="copy-button btn" data-password="{{ Crypt::decrypt($sales->password) }}">Copy</button> --}}
                {{-- </td> --}}

                    
                    {{-- <td><button class="copy-button" onclick="copyToClipboard(this)">Copy</button></td> --}}
                    


                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection

{{-- 
<script>
    function copyToClipboard(button) {
        const passwordText = button.previousElementSibling; // Dapatkan elemen teks kata sandi
        const tempInput = document.createElement('input');
        tempInput.value = passwordText.textContent;
        document.body.appendChild(tempInput);
        tempInput.select();
        document.execCommand('copy');
        document.body.removeChild(tempInput);
    
        // Gantilah teks tombol setelah menyalin
        button.textContent = 'Copied';
    
        // Kembalikan teks tombol setelah beberapa detik
        setTimeout(() => {
            button.textContent = 'Copy';
        }, 3000);
    }
    </script>
     --}}
{{-- 
     <script>
        function copyToClipboard(button) {
            const passwordText = button.getAttribute('data-password');
            const tempInput = document.createElement('input');
            tempInput.value = passwordText;
            document.body.appendChild(tempInput);
            tempInput.select();
            document.execCommand('copy');
            document.body.removeChild(tempInput);
        
            // Gantilah teks tombol setelah menyalin
            button.textContent = 'Copied';
        
            // Kembalikan teks tombol setelah beberapa detik
            setTimeout(() => {
                button.textContent = 'Copy';
            }, 3000);
        }
        </script> --}}

{{-- 
        <script>
            function copyToClipboard(button) {
                const passwordText = button.getAttribute('data-password');
                const tempInput = document.createElement('input');
                tempInput.value = passwordText;
                document.body.appendChild(tempInput);
                tempInput.select();
                document.execCommand('copy');
                document.body.removeChild(tempInput);
            
                // Gantilah teks tombol setelah menyalin
                button.textContent = 'Copied';
            
                // Kembalikan teks tombol setelah beberapa detik
                setTimeout(() => {
                    button.textContent = 'Copy';
                }, 3000);
            }
            </script> --}}

        
            
        