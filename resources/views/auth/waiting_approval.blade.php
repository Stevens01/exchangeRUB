<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>En Attente de Validation</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        body {
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            color: #333;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 20px;
        }
        
        .container {
            width: 100%;
            max-width: 800px;
            background: white;
            border-radius: 16px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            display: flex;
            flex-direction: column;
        }
        
        .header {
            background: #4a6cf7;
            color: white;
            padding: 30px;
            text-align: center;
        }
        
        .header h1 {
            font-size: 28px;
            margin-bottom: 10px;
        }
        
        .header p {
            opacity: 0.9;
        }
        
        .content {
            padding: 30px;
        }
        
        .status-card {
            background: #f0f5ff;
            border-radius: 12px;
            padding: 25px;
            display: flex;
            align-items: center;
            margin-bottom: 30px;
        }
        
        .status-icon {
            width: 70px;
            height: 70px;
            background: #4a6cf7;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 20px;
            flex-shrink: 0;
        }
        
        .status-icon i {
            font-size: 30px;
            color: white;
        }
        
        .status-text h2 {
            color: #2d3b55;
            margin-bottom: 5px;
        }
        
        .status-text p {
            color: #64748b;
        }
        
        .info-box {
            background: #f8fafc;
            border-radius: 12px;
            padding: 25px;
            margin-bottom: 30px;
        }
        
        .info-box h3 {
            color: #2d3b55;
            margin-bottom: 15px;
            padding-bottom: 10px;
            border-bottom: 1px solid #e2e8f0;
        }
        
        .process-steps {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }
        
        .step {
            background: white;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
            text-align: center;
            border-top: 4px solid #4a6cf7;
        }
        
        .step-number {
            width: 40px;
            height: 40px;
            background: #4a6cf7;
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 15px;
            font-weight: bold;
        }
        
        .step h4 {
            color: #2d3b55;
            margin-bottom: 10px;
        }
        
        .step p {
            color: #64748b;
            font-size: 14px;
        }
        
        .support-card {
            background: linear-gradient(135deg, #4a6cf7 0%, #3a5cd8 100%);
            color: white;
            border-radius: 12px;
            padding: 25px;
            display: flex;
            align-items: center;
        }
        
        .support-icon {
            font-size: 40px;
            margin-right: 20px;
            flex-shrink: 0;
        }
        
        .support-text h3 {
            margin-bottom: 10px;
        }
        
        .support-text p {
            opacity: 0.9;
        }
        
        .actions {
            display: flex;
            gap: 15px;
            margin-top: 30px;
            flex-wrap: wrap;
        }
        
        .btn {
            padding: 12px 25px;
            border: none;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }
        
        .btn-primary {
            background: #4a6cf7;
            color: white;
        }
        
        .btn-primary:hover {
            background: #3a5cd8;
        }
        
        .btn-outline {
            background: transparent;
            border: 1px solid #4a6cf7;
            color: #4a6cf7;
        }
        
        .btn-outline:hover {
            background: #4a6cf7;
            color: white;
        }
        
        .countdown {
            text-align: center;
            margin-top: 20px;
            padding: 15px;
            background: #f0f5ff;
            border-radius: 8px;
        }
        
        .countdown p {
            color: #64748b;
            margin-bottom: 5px;
        }
        
        .countdown span {
            font-weight: 600;
            color: #4a6cf7;
            font-size: 18px;
        }
        
        @media (max-width: 768px) {
            .status-card {
                flex-direction: column;
                text-align: center;
            }
            
            .status-icon {
                margin-right: 0;
                margin-bottom: 15px;
            }
            
            .support-card {
                flex-direction: column;
                text-align: center;
            }
            
            .support-icon {
                margin-right: 0;
                margin-bottom: 15px;
            }
            
            .actions {
                flex-direction: column;
            }
            
            .process-steps {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Bienvenue sur notre plateforme</h1>
            <p>Votre compte est en cours de validation</p>
        </div>
        
        <div class="content">
            <div class="status-card">
                <div class="status-icon">
                    <i class="fas fa-clock"></i>
                </div>
                <div class="status-text">
                    <h2>En attente de validation</h2>
                    <p>Votre compte est en cours d'examen par notre équipe. Cette procédure peut prendre jusqu'à 24 heures.</p>
                </div>
            </div>
            
            <div class="info-box">
                <h3>Processus de validation</h3>
                <p>Pour garantir la sécurité de tous nos utilisateurs, chaque nouveau compte doit être validé par notre équipe administrative. Nous vérifions les informations que vous avez fournies lors de votre inscription.</p>
            </div>
            
            <div class="process-steps">
                <div class="step">
                    <div class="step-number">1</div>
                    <h4>Inscription</h4>
                    <p>Vous avez complété votre inscription avec succès</p>
                </div>
                
                <div class="step">
                    <div class="step-number">2</div>
                    <h4>Vérification</h4>
                    <p>Notre équipe examine votre demande</p>
                </div>
                
                <div class="step">
                    <div class="step-number">3</div>
                    <h4>Activation</h4>
                    <p>Votre compte sera activé sous 24 heures</p>
                </div>
            </div>
            
            <div class="countdown">
                <p>Temps estimé avant activation de votre compte:</p>
                <span id="countdown-timer">23:45:12</span>
            </div>
            
            <div class="support-card">
                <div class="support-icon">
                    <i class="fas fa-headset"></i>
                </div>
                <div class="support-text">
                    <h3>Besoin d'aide ?</h3>
                    <p>Contactez notre support à support@example.com ou au 01 23 45 67 89</p>
                </div>
            </div>
            
            <div class="actions">
                <a href="{{ route('home') }}" class="btn btn-primary">
                    <i class="fas fa-home"></i> Retour à l'accueil
                </a>
                <a href="{{ route('logout') }}" class="btn btn-outline" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="fas fa-sign-out-alt"></i> Se déconnecter
                </a>
            </div>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </div>
    </div>

    <script>
     const targetTime = new Date('{{ $targetTime }}');
     
     function updateCountdown() {
          const now = new Date();
          const diff = targetTime - now;
          
          if (diff <= 0) {
               document.getElementById('countdown-timer').textContent = "00:00:00";
               // Optionnellement, rediriger ou actualiser la page
               window.location.reload();
               return;
          }
          
          const hours = Math.floor(diff / (1000 * 60 * 60));
          const minutes = Math.floor((diff % (1000 * 60 * 60)) / (1000 * 60));
          const seconds = Math.floor((diff % (1000 * 60)) / 1000);
          
          document.getElementById('countdown-timer').textContent = 
               `${hours.toString().padStart(2, '0')}:${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;
     }
     
     setInterval(updateCountdown, 1000);
     updateCountdown();
   </script>
</body>
</html>