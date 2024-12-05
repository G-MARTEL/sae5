<form action="sendMessage" method="post">
    @csrf
    <textarea name="message" id="message" cols="150" style="resize: none;" ></textarea>
    <br>
    <button type=submit>envoyer</button>
</form>
