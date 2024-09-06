<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StageRequest extends FormRequest
{
    public function authorize(): bool
    {
       
        return true;
    }

    public function rules(): array
    {
        return [
            'travel_id' => 'required|exists:travel,id',
            'title' => 'required|string|max:255',
            'stage_start_date' => 'required|date',
            'stage_end_date' => 'required|date',
            'start_time' => 'nullable|date_format:H:i',
            'end_time' => 'nullable|date_format:H:i',
            'description' => 'nullable|string',
        ];
    }


    public function messages(): array
    {
        return [
            'travel_id.required' => 'Il campo "Viaggio" è obbligatorio.',
            'travel_id.exists' => 'Il viaggio selezionato non esiste.',
            'title.required' => 'Il campo "Titolo" è obbligatorio.',
            'title.string' => 'Il campo "Titolo" deve essere una stringa.',
            'title.max' => 'Il campo "Titolo" non può superare i 255 caratteri.',
            'stage_start_date.required' => 'Il campo "Data inizio tappa" è obbligatorio.',
            'stage_start_date.date' => 'Il campo "Data inizio tappa" deve essere una data valida.',
            'stage_end_date.required' => 'Il campo "Data fine tappa" è obbligatorio.',
            'stage_end_date.date' => 'Il campo "Data fine tappa" deve essere una data valida.',
            'start_time.date_format' => 'Il campo "Ora di inizio" deve essere nel formato HH:MM.',
            'end_time.date_format' => 'Il campo "Ora di fine" deve essere nel formato HH:MM.',
            'description.string' => 'Il campo "Descrizione" deve essere una stringa.',
        ];
    }
}
