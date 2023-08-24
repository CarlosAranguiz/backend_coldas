<?php

namespace App\Exports;

use App\Models\PostEventAnswer;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class AnswersExport implements FromCollection, WithHeadings
{
    protected $eventId;

    public function __construct($eventId)
    {
        $this->eventId = $eventId;
    }

    public function collection()
    {
        return PostEventAnswer::whereHas('question', function ($query) {
            $query->where('event_id', $this->eventId);
        })
        ->with(['question', 'option'])
        ->get()
        ->map(function ($answer) {
            return [
                'Pregunta' => $answer->question->question_text,
                'Opción seleccionada' => optional($answer->option)->option_text,
                'Texto de respuesta' => $answer->answer_text,
            ];
        });
    }

    public function headings(): array
    {
        return [
            'Pregunta',
            'Opción seleccionada',
            'Texto de respuesta',
        ];
    }
}
