<?php

function concatFigure($i, $j, $to, &$result, $isFirst)
{
    if ($isFirst) {
        $result[$i][$j] = $to;
    }
    if (($isFirst == false && $result[$i][$j] == $to) || $result[$i][$j] == null || $result[$i][$j] == 0) {
        return false;
    } else {
        $result[$i][$j] = $to;
        concatFigure($i - 1, $j - 1, $to, $result, false);
        concatFigure($i - 1, $j, $to, $result, false);
        concatFigure($i - 1, $j + 1, $to, $result, false);
        concatFigure($i, $j - 1, $to, $result, false);
        concatFigure($i, $j + 1, $to, $result, false);
        concatFigure($i + 1, $j - 1, $to, $result, false);
        concatFigure($i + 1, $j, $to, $result, false);
        concatFigure($i + 1, $j + 1, $to, $result, false);
    }
}

function isThisFigureReturnNumberGroup($arr)
{
    $return = null;
    for ($i = 0; $i < sizeof($arr); $i++) {
        if ($arr[$i] != 0 && $arr[$i] != null && $return == null) {
            $return = $arr[$i];
        }
        if ($arr[$i] != 0 && $arr[$i - 1] != 0 && $arr[$i] != null && $arr[$i - 1] != null) {
            if ($arr[$i] != $arr[$i - 1]) {
                return $arr[$i];
            }
        }
    }
    return $return;
}

function isThisFigure($arr)
{
    for ($i = 1; $i < sizeof($arr); $i++) {
        if ($arr[$i] != 0 && $arr[$i - 1] != 0 && $arr[$i] != null && $arr[$i - 1] != null) {
            if ($arr[$i] != $arr[$i - 1]) {
                return false;
            }
        }
    }
    return true;
}

function getShapes($arr)
{
    $numberFigure = 0;
    $result = Array(Array());
    for ($i = 0; $i < sizeof($arr); $i++) {
        for ($j = 0; $j < sizeof($arr[$i]); $j++) {
            if ($arr[$i][$j] != 1) {
                //проверяем не начало ли это новой фигуры
                if ((
                        empty($result[$i - 1][$j - 1]) &&
                        empty($result[$i - 1][$j + 1]) &&
                        empty($result[$i][$j - 1]) &&
                        empty($result[$i][$j + 1]) &&
                        empty($result[$i + 1][$j - 1]) &&
                        empty($result[$i + 1][$j]) &&
                        empty($result[$i + 1][$j + 1])
                    ) && (($result[$i - 1][$j - 1] == 0) &&
                        ($result[$i - 1][$j + 1] == 0) &&
                        ($result[$i][$j - 1] == 0) &&
                        ($result[$i][$j + 1] == 0) &&
                        ($result[$i + 1][$j - 1] == 0) &&
                        ($result[$i + 1][$j] == 0) &&
                        ($result[$i + 1][$j + 1] == 0)
                    )
                ) {
                    $numberFigure++;
                    $result[$i][$j] = $numberFigure;
                } elseif (
                    //проверка на то что ее окружаю тот же номер фигуы
                    isThisFigure(
                        Array(
                            $result[$i - 1][$j - 1],
                            $result[$i - 1][$j],
                            $result[$i - 1][$j + 1],
                            $result[$i][$j - 1],
                            $result[$i][$j + 1],
                            $result[$i + 1][$j - 1],
                            $result[$i + 1][$j],
                            $result[$i + 1][$j + 1]
                        )
                    ) == true
                ) {
                    $result[$i][$j] = isThisFigureReturnNumberGroup(
                        Array(
                            $result[$i - 1][$j - 1],
                            $result[$i - 1][$j],
                            $result[$i - 1][$j + 1],
                            $result[$i][$j - 1],
                            $result[$i][$j + 1],
                            $result[$i + 1][$j - 1],
                            $result[$i + 1][$j],
                            $result[$i + 1][$j + 1]
                        )
                    );
                } else {
                    concatFigure($i, $j, isThisFigureReturnNumberGroup(
                        Array(
                            $result[$i - 1][$j - 1],
                            $result[$i - 1][$j],
                            $result[$i - 1][$j + 1],
                            $result[$i][$j - 1],
                            $result[$i][$j + 1],
                            $result[$i + 1][$j - 1],
                            $result[$i + 1][$j],
                            $result[$i + 1][$j + 1]
                        )
                    ), $result, true);
                }
            } else {
                $result[$i][$j] = 0;
            }
        }
    }
    return $result;
}

