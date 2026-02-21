<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $data['subject'] }}</title>
    <style>
        body { font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; line-height: 1.6; color: #333; margin: 0; padding: 0; }
        .container { width: 100%; max-width: 600px; margin: 0 auto; border: 1px solid #eee; }
        .cover-image { width: 100%; height: auto; display: block; }
        .content { padding: 20px; }
        h1 { color: #2c3e50; font-size: 24px; }
        p { margin-bottom: 15px; }
    </style>
</head>
<body>
    <div class="container">
        {{-- Cover Image Logic --}}
        @if(!empty($data['image']))
             <img src="{{ $data['image'] }}" alt="Destination Preview" class="cover-image">
        @endif

        <div class="content">
            <h1>{{ $data['subject'] }}</h1>
            
            <p>{!! nl2br(e($data['message'])) !!}</p>
            
            {{-- Optional: Call to Action button for a Travel Agency --}}
            @if (!empty($data['btn_link']) && !empty($data['btn_label']))
            <div style="margin-top: 30px; text-align: center;">
                <a href="{{ $data['btn_link'] }}" style="background-color: #ff5a5f; color: white; padding: 12px 25px; text-decoration: none; border-radius: 5px; font-weight: bold;">
                    {{  $data['btn_label']}}
                </a>
            </div>
            @endif
            
        </div>
    </div>
</body>
</html>