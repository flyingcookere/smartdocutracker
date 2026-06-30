<div>
    <!-- He who is contented is rich. - Laozi -->
    <p>Hi <strong>{{ $name }}</strong> !</p>
    <br>
    <br>
    @if($status == 'Returned')
        <p>We would like to inform you that the document <strong>{{ $title }}</strong> has been returned since <strong>{{ $daysSince }} days</strong> ago.</p>
        <p>Have you ever received it?</p>
        <p>If you ever received it, kindly disregard this message.</p>
    @elseif($status == 'Pending')
        <p>We would like to remind you that document <strong>{{ $title }}</strong> is still <strong>{{ $status }}</strong> for <strong>{{ $daysSince }}</strong></strong> days.</p>
    @endif    
    <p>Tracking Details: <a href="{{ $url }}">{{ $url }}</a></p>
     <br>
     <br>
     <p>You may contact the following:</p>
     <br>
     @if($received_by != null)
        <p><strong>{{ $received_by }}</strong></p>
        <a href="mailto:{{ $receiving_email }}?subject={{ $title }}"><strong>{{ $receiving_email }}</strong></a>
        <br>
        <br>
     @else
        @foreach($users as $user)
            @if($sender_dept === $user->department)
                <p><strong>{{ $user->name }}</strong></p>
                <a href="mailto:{{ $user->email }}?subject={{ $title }}"><strong>{{ $user->email }}</strong></a>
                <br>
                <br>
            @endif
        @endforeach
     @endif
    <p>Thank You!</p>   
</div>
