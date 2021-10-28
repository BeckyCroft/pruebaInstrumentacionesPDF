<?php

use PhpParser\Node\Stmt\Foreach_;
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Instrumentacion</title>
    <style type="text/css">
        .left {
            float: left;
        }

        .right {
            float: right;
            text-align: left;
        }
    </style>
</head>

<body>
    <h2>Instrumentación Didáctica para la formación y desarrollo de competencias profesionales</h2>
    <br>
    <div align="center">
        <div>
            <?php
            $meses = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");

            $fecha_inicio_periodo = strtotime($instrumentacion->fecha_inicio_periodo);
            $inicio = date('Y-m-d', $fecha_inicio_periodo);
            $mes_inicio =  $meses[date('n', $fecha_inicio_periodo) - 1];

            $fecha_fin_periodo = strtotime($instrumentacion->fecha_fin_periodo);
            $fin = date('Y-m-d', $fecha_fin_periodo);
            $mes_fin = $meses[date('n', $fecha_fin_periodo) - 1];

            $anio = date("Y", $fecha_fin_periodo);

            ?>
            <p>Periodo: <?= $mes_inicio ?> - <?= $mes_fin ?> <?= $anio ?></p>
            <p>Asignatura: <?= $instrumentacion->nombre_asignatura ?></p>
            <p>Plan de estudios: <?= $instrumentacion->plan_estudios ?></p>
            <p>Clave de la asignatura: <?= $instrumentacion->clave_asignatura ?></p>
            <p>Horas teoría-Horas prácticas-Créditos: <?= $instrumentacion->horas_teoria ?>-<?= $instrumentacion->horas_practica ?>-<?= $instrumentacion->creditos ?></p>

        </div>
    </div>
    <div>
        <h3>1. Caracterizacion de la asignatura</h3>
        <p><?= $instrumentacion->caracterizacion_asignatura ?></p>
        <h3>2. Intención Didáctica</h3>
        <p><?= $instrumentacion->intencion_didactica ?></p>
        <h3>3. Competencia de la asignatura</h3>
        <p><?= $instrumentacion->competencia_asignatura ?></p>
        <h3>3.1 Análisis por competencias específicas</h3>
        <p>Competencia No.:<?= $competencia->numero_competencia ?> Descripción: <?= $competencia->descripcion_competencia ?></p>
        <br>
        <br>
        <br>
        <table>
            <thead>
                <tr>
                    <th>TEMAS Y SUBTEMAS PARA DESARROLLAR LA COMPETENCIA ESPECÍFICA</th>
                    <th>ACTIVIDADES DE APRENDIZAJE</th>
                    <th>ACTIVIDADES DE ENSEÑANZA</th>
                    <th>DESARROLLO DE COMPETENCIAS GENÉRICAS</th>
                    <th>HORAS TEÓRICO-PRÁCTICA</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><?= $competencia->nombre_tema ?> <br><br> <?= $competencia->subtemas_competencia ?></td>
                    <td>
                        Realiza una evaluación diagnóstica aplicada por el docente.
                        <?php foreach ($actividadesCompetencia as $actividad) : ?>
                            <?= $actividad->descripcion_actividad ?> <br>
                            (<?= $actividad->nombre_corto ?>)
                            <br><br>
                        <?php endforeach; ?>
                    </td>
                    <td><?= $competencia->actividad_ensenanza ?></td>
                    <td><?= $competencia->competencias_genericas ?></td>
                    <td><?= $competencia->horas_teorico + $competencia->horas_practica ?> <br><?= $competencia->horas_teorico ?>-<?= $competencia->horas_practica ?></td>
                </tr>
            </tbody>
        </table>

        <table>
            <thead>
                <tr>
                    <th>INDICADORES DE ALCANCE</th>
                    <th>VALOR DEL INDICADOR</th>
                </tr>
            </thead>
            <tbody>

                <?php foreach ($matriz as $m) : ?>
                    <tr>
                        <td><?= $m->inciso ?>. <?= $m->descripcion_indicador ?></td>
                        <td align="center"><?= $m->valor ?></td>
                    </tr>
                <?php endforeach; ?>

            </tbody>
        </table>

        <h3>Niveles de desempeño:</h3>
        <table>
            <thead>
                <tr>
                    <th>DESEMPEÑO</th>
                    <th>NIVEL DE DESEMPEÑO</th>
                    <th>INDICADORES DE ALCANCE </th>
                    <th>VALORACIÓN NUMÉRICA</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($nivelesCompetencia as $nivel) : ?>
                    <tr>
                        <td><?= $nivel->desempenio ?></td>
                        <td><?= $nivel->nivel_desempenio ?></td>
                        <td><?= $nivel->indicador_alcance ?></td>
                        <td><?= $nivel->valoracion_numerica ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <h3>Matriz de evaluación:</h3>
        <table border="1" class="table">
            <thead>
                <tr>
                    <td rowspan="2">EVIDENCIA DE APRENDIZAJE</td>
                    <td rowspan="2">%</td>
                    <td colspan="3">INDICADOR DE ALCANCE</td>
                    <td rowspan="2">EVALUACIÓN FORMATIVA DE LA COMPETENCIA</td>
                </tr>
                <tr>
                    <?php foreach ($matriz as $m) : ?>
                        <td><?= $m->inciso ?></td>
                    <?php endforeach; ?>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($matriz as $m) : ?>
                    <tr>
                        <td><?= $m->nombre_corto ?> <br><?= $m->nombre_largo ?></td>
                        <td><?= $m->ponderacion ?></td>
                        <?php foreach ($matriz as $ma) : ?>
                            <td><?= $ma->inciso ?></td>
                        <?php endforeach; ?>
                        <td><?= $m->evaluacion_formativa ?></td>
                    </tr>
                <?php endforeach; ?>
                <tr>
                    <td></td>
                    <td>Total</td>
                    <?php foreach ($matriz as $m) : ?>
                        <td><?= $m->valor ?></td>
                    <?php endforeach; ?>
                    <td>100%</td>
                </tr>
            </tbody>
        </table>

        <h3>Fuentes de información y apoyos didácticos:</h3>
        <table>
            <thead>
                <tr>
                    <th>Fuentes de Información</th>
                    <th>Apoyos Didácticos</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <?php foreach ($fuentesCompetencia as $fuente) : ?>
                            <?= $fuente->fuente_descripcion ?>
                            <br>
                            <br>
                        <?php endforeach; ?>
                    </td>
                    <td><?= $competencia->apoyo_didactico ?></td>
                </tr>
            </tbody>
        </table>
    </div>

    <p align="right">Fecha de elaboración: <?= $instrumentacion->fecha_creacion ?></p>


    <div>
        <div class="left">
            <p>Prospecto de Ingeniero: <?= $instrumentacion->nombre_funcionario ?> <?= $instrumentacion->apaterno_funcionario ?> <?= $instrumentacion->amaterno_funcionario ?></p>
            <p>Nombre y Firma del Docente</p>
        </div>
        <div class="right">
            <p>Prospecto de Ingeniero: <?= $instrumentacion->supervisor ?></p>
            <p>Vo. Bo. Jefe del Departamento</p>
        </div>
    </div>

    <div id="piedepagina">

    </div>
    <!-- constancia parcial -->

</body>

</html>