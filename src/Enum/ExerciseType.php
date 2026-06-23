<?php

namespace App\Enum;

enum ExerciseType: string
{
    case WARMUP = 'warmup';
    case INTERVAL = 'interval';
    case RECOVERY = 'recovery';
    case COOLDOWN = 'cooldown';
    case FREE_RUN = 'free_run';
}