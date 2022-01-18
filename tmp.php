<body>
    <img src="imgs/nail.jpg" id="logo">
    <div class="navegacion">
        <ul type="none" id="enlaces">
            <li class="hoverable"><a href="cita.php">Pide Cita</a></li>
            <li class="hoverable"><a href="#">Contáctanos</a></li>
            <li class="hoverable"><a href="#">Conócenos</a></li>
            </ul>                                    <div class="card-panel hoverable valign-wrapper hoverable" id="panel">
                        <i class="material-icons" id="iconoPanel">admin_panel_settings</i> Panel de Administración
                    </div>
                    <script>
                        var panel = document.getElementById("panel");
                        panel.onclick = function() {
                            window.open("b09c600fddc573f117449b3723f23d64/b09c600fddc573f117449b3723f23d64.php", '_blank')
                        }
                    </script>
                                <div class="container">
                    <div class="card-panel col s6 m6 center-align hoverable" id="comentarioNombre">
                        <p>
                            ¡Bienvenid@ Dónovan!                        </p>
                    </div>
                </div>
                <div id="divCS">
                    <i class="bi bi-gear" id="opciones" onclick="show()"></i>
                    <i class="bi bi-bell" id="notificaciones" onclick="showNotificaciones()"></i>
                    <span class="punto" id="puntoNotificaciones" onclick="showNotificaciones()"></span>
                    <script>
                        var clicks = 0;
                        var clickeado;

                        function showNotificaciones() {
                            var punto = document.getElementById("puntoNotificaciones")
                            var listaNotificaciones = document.getElementById("listaNot");
                            var campana = document.getElementById("notificaciones");
                                                            punto.style.visibility = 'hidden';
                                listaNotificaciones.style.visibility = 'hidden';
                                if (clicks == 0) {
                                    listaNotificaciones.style.visibility = 'visible';
                                    punto.style.visibility = 'hidden';
                                    campana.className = "bi bi-bell-fill seleccionado"
                                    clicks++;
                                } else {
                                    listaNotificaciones.style.visibility = 'hidden';
                                    punto.style.visibility = 'hidden'
                                    campana.className = "bi bi-bell"
                                    clicks = 0;
                                }

                            }
                                            </script>
                </div>
                <ul class="collection with-header hoverable" id="listaNot">
                    <li class="collection-header">
                        <h4>Notificaciones</h4>
                    </li>
                                            <li class="collection-item">
                                ¡Has iniciado sesión correctamente!                            </li>
                                                                            <li class="collection-item">
                                    <p>Recordatorio: Tienes una cita el día 18-01-2022 a las 09:00 AM</p>                                </li>
                                                </ul>
                <ul class="collection" id="listaShow" style="visibility: hidden;">
                    <li class="collection-item" onclick="window.location.href='php/logout.php'">Cerrar sesión</li>
                </ul>
                                <div class="container">
                    <div class="row">
                        <div class="card-panel col s12 m6 hoverable" id="col1">
                            <p>
                                Lorem ipsum dolor sit amet consectetur adipisicing elit.
                                Omnis ut iure, ea, nisi sapiente dolorem facilis neque itaque
                                ad tempora earum ex quidem. Dignissimos perspiciatis modi asperiores, suscipit minima maiores iure
                                tempora esse. Animi, possimus mollitia labore dolor impedit temporibus ipsum hic neque cumque nesciunt
                                debitis
                                ea! Numquam, dolorum fugiat. 1
                            </p>
                        </div>
                        <div class="card-panel col s12 m6 hoverable" id="col2">
                            <p>
                                Lorem ipsum, dolor sit amet consectetur adipisicing elit.
                                Nihil eligendi laudantium deleniti minima et quia ab reprehenderit
                                vel maxime quibusdam voluptates dolorem amet culpa quos dolor quisquam,
                                cum ex fugit repellendus autem maiores, iure molestias!
                                Voluptates odio culpa illo at praesentium harum
                                rerum blanditiis ipsam, porro omnis, quos doloremque inventore. 2
                            </p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="card-panel col s12 m6 hoverable" id="col3">
                            <p>
                                Lorem ipsum dolor sit amet consectetur adipisicing elit.
                                Omnis ut iure, ea, nisi sapiente dolorem facilis neque itaque
                                ad tempora earum ex quidem. Dignissimos perspiciatis modi asperiores, suscipit minima maiores iure
                                tempora esse. Animi, possimus mollitia labore dolor impedit temporibu ipsum hic neque cumque nesciunt
                                debitis
                                ea! Numquam, dolorum fugiat. 3
                            </p>
                        </div>
                        <div class="card-panel col s12 m6 hoverable" id="col4">
                            <p>
                                Lorem ipsum, dolor sit amet consectetur adipisicing elit.
                                Nihil eligendi laudantium deleniti minima et quia ab reprehenderit
                                vel maxime quibusdam voluptates dolorem amet culpa quos dolor quisquam,
                                cum ex fugit repellendus autem maiores, iure molestias!
                                Voluptates odio culpa illo at praesentium harum
                                rerum blanditiis ipsam, porro omnis, quos doloremque inventore. 4
                            </p>
                        </div>
                    </div>
                </div>
    </div>


</body>