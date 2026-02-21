<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $data['subject'] }}</title>
    <style>
        /* Modern reset and typography */
        body { 
            font-family: 'Segoe UI', Roboto, Helvetica, Arial, sans-serif; 
            line-height: 1.8; 
            color: #444; 
            margin: 0; 
            padding: 0; 
            background-color: #f9f9f9; 
        }
        .wrapper { width: 100%; table-layout: fixed; background-color: #f9f9f9; padding-bottom: 40px; }
        .container { 
            width: 100%; 
            max-width: 600px; 
            margin: 20px auto; 
            background-color: #ffffff; 
            border-radius: 8px; 
            overflow: hidden; 
            border: 1px solid {{ !empty($data['btn_color']) ? $data['btn_color'] : '#000000' }};
        }
        
        /* Header & Logo */
        .header { padding: 25px; text-align: center; background-color: #ffffff; }
        .logo { width: 120px; height: auto; }
        
        /* Visuals */
        .cover-image { width: 100%; height: auto; display: block; border-bottom: 4px solid {{ $data['btn_color'] ?? '#ff7b40' }}; }
        
        /* Content */
        .content { padding: 40px 30px; }
        h1 { 
            color: #1a1a1a; 
            font-size: 26px; 
            font-weight: 700; 
            margin-top: 0; 
            letter-spacing: -0.5px; 
        }
        p { margin-bottom: 20px; font-size: 16px; color: #555; }
        
        /* Button */
        .cta-container { margin-top: 35px; text-align: center; }
        .button {
            display: inline-block;
            padding: 15px 35px;
            color: #ffffff !important;
            text-decoration: none;
            border-radius: 4px;
            font-weight: 600;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }

        /* Footer suggestion */
        .footer { 
            padding: 20px; 
            text-align: center; 
            font-size: 12px; 
            color: #999; 
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="container">
            

            @if(!empty($data['image']))
                 <img src="{{ $data['image'] }}" alt="Destination Preview" class="cover-image">
            @endif

            <div class="content">
                <h1>{{ $data['subject'] }}</h1>
                
                <p>{!! nl2br(e($data['message'])) !!}</p>
                
                @if (!empty($data['btn_link']) && !empty($data['btn_label']))
                <div class="cta-container">
                    <a href="{{ $data['btn_link'] }}" class="button" style="background-color: {{ $data['btn_color'] ?? '#ff7b40' }};">
                        {{ $data['btn_label'] }}
                    </a>
                </div>
                @endif
            </div>

            <div class="footer">
                &copy; {{ date('Y') }} Iccheghuri Tours. All rights reserved.
            </div>
        </div>
    </div>
</body>
</html>