<html>
    <head>
        <title>Tracking</title>
        <style>
            video, canvas {
                position: absolute;
                border: 1px solid red;
            }
        </style>
    </head>
    <body>

    <video id="video" width="320" height="240" preload autoplay loop muted></video>
    <canvas id="canvas" width="320" height="240"></canvas>

    <script src="tracking-min.js"></script>    
    <script src="data/face-min.js"></script>    
    <script>
        function iniciar(){
            const video = document.getElementById('video');
            const canvas = document.getElementById('canvas');
            const contexto = canvas.getContext('2d');
            const tracker = new tracking.ObjectTracker('face');

            tracking.track("#video", tracker, {camera: true});
            tracker.on('track', event => {
                contexto.clearRect(0, 0, canvas.width, canvas.height);
                event.data.forEach( retangulo => {
                    // console.info(retangulo.x)
                    contexto.strokeStyle = '#ff0000';
                    contexto.lineWidth = 2;
                    contexto.strokeRect(retangulo.x, retangulo.y, retangulo.width, retangulo.height);
                    contexto.fillText(`x: ${retangulo.x}, w: ${retangulo.width}`,
                                         retangulo.x + retangulo.width + 20, retangulo.y + 20);
                    contexto.fillText(`y: ${retangulo.y}, h: ${retangulo.height}`,
                                         retangulo.x + retangulo.height + 20, retangulo.y + 40);
                })
                // console.info(event)
            });

        }
        window.onload = iniciar();
    </script>
    </body>
</html>