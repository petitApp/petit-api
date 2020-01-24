<div style="color:black;">
<h1>Hello {{ $data["name"]}}!</h1>
    <p>Reciving this email means you have requested a new password.</p>
    </br>
    <p>If you are not the person who owns this account, please ignore this message.</p>

    <div style="text-align:center;">
        Your new pass is:
        <span style="color: red">
        {{ $data["password"]}}
        </span>
    </div>
</div>
