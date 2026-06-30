<div>
    <!-- Well begun is half done. - Aristotle -->
    <p>Hi, <strong>{{ $name }}</strong>!</p> 
    <br>
    <p>BulSU Docutracker would like to keep you updated on the status of your document:</p>
    <p><strong>Document Title:</strong> {{ $title }}</p>
    <p><strong>Date Received:</strong> {{ $received_date }} </p>
    <p><strong>Received By:</strong> {{ $received_by }}</p>
    <p><strong>Contact Email:</strong> {{ $received_by_email }}</p>
    <p><strong>Recipient's Department:</strong> {{ $received_by_dept }}</p>
    <p><strong>Status:</strong> {{ $status }}</p>    
    <p><strong>Remarks:</strong> <i>{{ $remarks == null ? '*No remarks' : $remarks }}</i></p>
    <p><strong>UUID:</strong> {{ $uuid }}</p>
    <br>
    <p>You can track your document using the link below:</p>
    <p><strong>URL:</strong> <a href="{{ $url }}">{{ $url }}</a></p> 
    <br>
    <p>Thank you!</p>
</div>
