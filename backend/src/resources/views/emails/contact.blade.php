<h2 style="list-style: none; vertical-align: middle; margin-top: 0px; margin-bottom: 0.5em; line-height: 1em; font-size: 2em; font-family:  Helvetica, Arial, sans-serif; text-align: center; color: rgb(51, 51, 51); ">Contato do Site</h2>
<p style="color: rgb(51, 51, 51); font-family: Helvetica, Arial, sans-serif; padding-bottom:10px;" >
    Filial    :  {{ $branch }} <br />
    Nome      :  {{ $request->name }} <br />
    E-mail    :   {{ $request->email }} <br />
    Assunto   :   {{ $request->subject }} <br />
    Telefone  :   {{ $request->phone }} <br />
    Mensagem  :   {{ $request->message }} <br />
</p>
