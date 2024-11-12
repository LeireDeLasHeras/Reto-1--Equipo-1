<?php

/**
 * Vista para mostrar las publicaciones guardadas de un usuario
 * 
 * @author: Oier Albeniz
 * @author: Leire de las Heras
 * @author: Joseba Fernández
 * 
 * @copyright (c) 2024, Oier Albeniz, Leire de las Heras, Joseba Fernández
 */
?>

<?php $tipo = $_GET['tipo'] ?>

<div class="main-content">
    <div class="content-left-publicacion-guardados">
        <h1 class="titulo">Mis publicaciones guardadas</h1>

        <?php if ($tipo == 'todas' || $tipo == 'preguntas'): ?>
            <h2 class="seccion">Preguntas</h2>

            <?php if (empty($dataToView['data']['preguntas'])): ?>
                <p class="no-guardadas">No has guardado ninguna pregunta.</p>
            <?php else: ?>
                <ul>
                    <?php foreach ($dataToView['data']['preguntas'] as $pregunta): ?>
                        <li>
                            <a href="index.php?controller=pregunta&action=view&id=<?php echo $pregunta['idPregunta']; ?>">
                                <?php echo $pregunta['titulo']; ?>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>
        <?php endif; ?>

        <?php if ($tipo == 'todas' || $tipo == 'tutoriales'): ?>
            <h2 class="seccion">Tutoriales</h2>

            <?php if (empty($dataToView['data']['tutoriales'])): ?>
                <p class="no-guardadas">No has guardado ningún tutorial.</p>
            <?php else: ?>
                <ul>
                    <?php foreach ($dataToView['data']['tutoriales'] as $tutorial): ?>
                        <li>
                            <a href="index.php?controller=tutorial&action=view&id=<?php echo $tutorial['idTutorial']; ?>">
                                <?php echo $tutorial['titulo']; ?>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>
        <?php endif; ?>

        <?php if ($tipo == 'todas' || $tipo == 'guias'): ?>
            <h2 class="seccion">Guias</h2>

            <?php if (empty($dataToView['data']['guias'])): ?>
                <p class="no-guardadas">No has guardado ninguna guía.</p>
            <?php else: ?>
                <ul>
                    <?php foreach ($dataToView['data']['guias'] as $guia): ?>
                        <li>
                            <a href="index.php?controller=guia&action=view&id=<?php echo $guia['idGuia']; ?>">
                                <?php echo $guia['titulo']; ?>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>
        <?php endif; ?>

        <?php if ($tipo == 'todas' || $tipo == 'respuestas'): ?>
            <h2 class="seccion">Respuestas</h2>

            <?php if (empty($dataToView['data']['respuestas'])): ?>
                <p class="no-guardadas">No has guardado ninguna respuesta.</p>
            <?php else: ?>
                <ul>
                    <?php foreach ($dataToView['data']['respuestas'] as $respuesta): ?>
                        <li>
                            <a href="index.php?controller=pregunta&action=view&id=<?php echo $respuesta['idPregunta']; ?>">
                                <?php echo strlen($respuesta['descripcion']) > 15 ? substr($respuesta['descripcion'], 0, 15) . '...' : $respuesta['descripcion']; ?>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>
        <?php endif; ?>
    </div>

    <div class="sidebar">
        <h3>Tipos</h3>
        <div class="topics">
            <p><a href="index.php?controller=user&action=guardadas&tipo=todas" class="tema">Todos</a></p>
            <p><a href="index.php?controller=user&action=guardadas&tipo=preguntas" class="tema">Preguntas</a></p>
            <p><a href="index.php?controller=user&action=guardadas&tipo=tutoriales" class="tema">Tutoriales</a></p>
            <p><a href="index.php?controller=user&action=guardadas&tipo=guias" class="tema">Guias</a></p>
        </div>
    </div>
</div>