@foreach ($messages as $message)
    <h1>
        <strong>De : </strong>{{ $message->Sender->first_name }} {{ $message->Sender->last_name }}<br/>
        <strong>A : </strong>{{ $message->Recipient->first_name }} {{ $message->Recipient->last_name }}<br/>
        <strong>Date : </strong>{{ $message->creation_date }}<br/>
        <strong>Message : </strong>{{ $message->MessageContent->content}}<br/>
        <hr> 
    </h1>    
@endforeach


<form action="sendMessage" method="post">
    @csrf
    <textarea name="message" id="message" cols="150" style="resize: none;" ></textarea>
    <br>
    <button type=submit>envoyer</button>
</form>
