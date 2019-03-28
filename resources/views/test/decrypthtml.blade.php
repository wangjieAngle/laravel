<!doctype html>
<html>
<head>
    <title>JavaScript RSA Encryption</title>
    <script src="{{asset('js/jquery-3.2.1.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('js/jsencrypt.min.js')}}" type="text/javascript"></script>
    <script type="text/javascript">

        // Call this code when the page is done loading.
        $(function() {

            // Run a quick encryption/decryption when they click.
            $('#testme').click(function() {
                /*console.log(1);
                 return false;*/

                // Encrypt with the public key...
                var encrypt = new JSEncrypt();
                encrypt.setPublicKey($('#pubkey').val());
                var encrypted = encrypt.encrypt($('#input').val());
                $('.encrypt').val(encrypted);

                // Decrypt with the private key...
                var decrypt = new JSEncrypt();
                decrypt.setPrivateKey($('#privkey').val());
                var uncrypted = decrypt.decrypt(encrypted);
                console.log(uncrypted);
                // Now a simple check to see if the round-trip worked.
                if (uncrypted == $('#input').val()) {
                    alert('It works!!!');
                }
                else {
                    alert('Something went wrong....');
                }
            });
        });
    </script>
</head>
<body>
<label for="privkey">Private Key</label><br/>
<textarea id="privkey" rows="15" cols="65">-----BEGIN RSA PRIVATE KEY-----
MIICXAIBAAKBgQDh8zk3VCmEHB6RqBkNBUi3fzdOb2cXkuO+amDty613tRDBUByn
h1VazhSPqdbY2OSRnLFjQXpzZBhR+k/0xa4rwnUma9XAHQxSkRaQ2otHMYYxfSKF
rWW30cPOamuiLWrqLBWYmkCzgwt2HyXcV4Lmm+pQ9bz4F6j5gxaCJmZJ/wIDAQAB
AoGAVjZlyHS2eo/4If+Pv2YavtktkyHypg4IE+mnHlSu1ZQi1n/ozwtWSBWFxuM4
9PidDepJzON5A3pXxT/LLkwXDifH/Jh1r9hIr4GfV4PKjI/JIvqE2f9CwkcDTO4A
oNrOxGvsSsVul9O2q3VrLjUHShv57ictQse1beKgVetx66ECQQD2SvDo+RTACZpo
3gaOMWvA12C3fh6lSQJlpCONGjlt1CuTyGSuMxEgxTDxGEn0r/uK0eiMhApJ/7Zm
o55k0pWHAkEA6tsHK+bCr0todwVSBWd4Mankx5wLGO9XMsb9jNCCfckpfQBAFkzE
Px0aco5dK0z1ZMwOEEjb5fFG9bpnT5LFyQJBAIjyqLxSa8hQTqyK8Eg2kLzcxami
FjY/v3Z261G1SEOam1SEM/9s49Q98XXN1KmbBRpul4kyjmoRJwIxboyPT5cCQG9H
uv0tSUAgHe6PYc7XuRbnJlUCdiupdIrFyOwI/Fu3jmYBUVx/oVk6ZAa1uCXFQF0z
ZtKGg1NP4MycN0l4BSkCQBvWckWvt6R/A7W57SmV9HBONigakWCjBixfQ5kUcTP0
Qw/dktHwAF/HxGvqwAF4o6bsCHQM/s7niQpqKcB8Cgg=
-----END RSA PRIVATE KEY-----</textarea><br/>
<label for="pubkey">Public Key</label><br/>
<textarea id="pubkey" rows="15" cols="65">-----BEGIN PUBLIC KEY-----
MIGfMA0GCSqGSIb3DQEBAQUAA4GNADCBiQKBgQDh8zk3VCmEHB6RqBkNBUi3fzdO
b2cXkuO+amDty613tRDBUBynh1VazhSPqdbY2OSRnLFjQXpzZBhR+k/0xa4rwnUm
a9XAHQxSkRaQ2otHMYYxfSKFrWW30cPOamuiLWrqLBWYmkCzgwt2HyXcV4Lmm+pQ
9bz4F6j5gxaCJmZJ/wIDAQAB
-----END PUBLIC KEY-----</textarea><br/>
<label for="input">Text to encrypt:</label><br/>
<textarea id="input" name="input" type="text" rows=4 cols=70>This is a test!</textarea><br/>
<input id="testme" type="button" value="Test Me!!!" /><br/>


<form action="{{route('decryptname')}}">
    <input class="encrypt" type="text" name="encrypt">
    <button>提交解密</button>
</form>



</body>
</html>