<?php

namespace Database\Seeders;

use App\Models\Pet;
use App\Models\User;
use App\Models\MedicalRecord;
use App\Models\Vaccination;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class ClinicalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get Admin and Veterinarian users who can register clinical histories
        $vet = User::where('email', 'vet@vetcare.com')->first() 
            ?? User::where('role', 'veterinario')->first();
        $admin = User::where('email', 'admin@vetcare.com')->first() 
            ?? User::where('role', 'admin')->first();

        if (!$vet || !$admin) {
            $this->command->warn('Vets or Admins not found. Make sure UserSeeder is run first.');
            return;
        }

        $pets = Pet::all();

        foreach ($pets as $pet) {
            // Let's seed at least 2 medical records per pet to show a timeline
            if ($pet->species === 'perro') {
                // Record 1 (Older visit)
                MedicalRecord::create([
                    'pet_id' => $pet->id,
                    'user_id' => $vet->id,
                    'weight_at_visit' => $pet->weight - 1.5,
                    'diagnosis' => 'Consulta de control anual de salud y desparasitación preventiva.',
                    'treatment' => 'Administración oral de desparasitante de amplio espectro. Se aconseja mantener dieta balanceada.',
                    'created_at' => Carbon::now()->subMonths(6),
                    'updated_at' => Carbon::now()->subMonths(6),
                ]);

                // Record 2 (Recent visit)
                MedicalRecord::create([
                    'pet_id' => $pet->id,
                    'user_id' => $admin->id,
                    'weight_at_visit' => $pet->weight,
                    'diagnosis' => 'Otitis externa leve detectada en el oído derecho.',
                    'treatment' => 'Limpieza de conducto auditivo externo. Aplicación de gotas óticas (Conofite) 4 gotas cada 12 horas por 7 días.',
                    'created_at' => Carbon::now()->subWeeks(2),
                    'updated_at' => Carbon::now()->subWeeks(2),
                ]);

                // Seed some vaccinations
                Vaccination::create([
                    'pet_id' => $pet->id,
                    'name' => 'Vacuna Sextuple',
                    'dose' => '1 ml',
                    'date_applied' => Carbon::now()->subMonths(6)->format('Y-m-d'),
                    'next_dose_due' => Carbon::now()->addMonths(6)->format('Y-m-d'),
                ]);

                Vaccination::create([
                    'pet_id' => $pet->id,
                    'name' => 'Antirrábica',
                    'dose' => '1 ml',
                    'date_applied' => Carbon::now()->subMonths(2)->format('Y-m-d'),
                    'next_dose_due' => Carbon::now()->addMonths(10)->format('Y-m-d'),
                ]);

            } elseif ($pet->species === 'gato') {
                // Record 1 (Older visit)
                MedicalRecord::create([
                    'pet_id' => $pet->id,
                    'user_id' => $vet->id,
                    'weight_at_visit' => $pet->weight - 0.30,
                    'diagnosis' => 'Control de peso e inicio de plan de vacunación básica.',
                    'treatment' => 'Recomendación de alimento húmedo premium. Controlar raciones diarias.',
                    'created_at' => Carbon::now()->subMonths(4),
                    'updated_at' => Carbon::now()->subMonths(4),
                ]);

                // Record 2 (Recent visit)
                MedicalRecord::create([
                    'pet_id' => $pet->id,
                    'user_id' => $vet->id,
                    'weight_at_visit' => $pet->weight,
                    'diagnosis' => 'Chequeo preventivo de rutina e higiene dental.',
                    'treatment' => 'Profilaxis dental recomendada para el próximo mes. Cepillado preventivo en casa.',
                    'created_at' => Carbon::now()->subWeeks(3),
                    'updated_at' => Carbon::now()->subWeeks(3),
                ]);

                // Seed some vaccinations
                Vaccination::create([
                    'pet_id' => $pet->id,
                    'name' => 'Triple Viral Felina',
                    'dose' => '1 ml',
                    'date_applied' => Carbon::now()->subMonths(4)->format('Y-m-d'),
                    'next_dose_due' => Carbon::now()->addMonths(8)->format('Y-m-d'),
                ]);

                Vaccination::create([
                    'pet_id' => $pet->id,
                    'name' => 'Antirrábica',
                    'dose' => '1 ml',
                    'date_applied' => Carbon::now()->subMonths(1)->format('Y-m-d'),
                    'next_dose_due' => Carbon::now()->addMonths(11)->format('Y-m-d'),
                ]);

            } elseif ($pet->species === 'conejo') {
                // Record 1
                MedicalRecord::create([
                    'pet_id' => $pet->id,
                    'user_id' => $vet->id,
                    'weight_at_visit' => $pet->weight,
                    'diagnosis' => 'Control rutinario y revisión dental de incisivos.',
                    'treatment' => 'Dientes con desgaste óptimo. Aumentar proporción de heno de alfalfa en la dieta para mantener el correcto desgaste.',
                    'created_at' => Carbon::now()->subMonths(2),
                    'updated_at' => Carbon::now()->subMonths(2),
                ]);

                // Seed some vaccinations
                Vaccination::create([
                    'pet_id' => $pet->id,
                    'name' => 'Mixomatosis',
                    'dose' => '0.5 ml',
                    'date_applied' => Carbon::now()->subMonths(2)->format('Y-m-d'),
                    'next_dose_due' => Carbon::now()->addMonths(4)->format('Y-m-d'),
                ]);

            } else {
                // Aves / Otros
                MedicalRecord::create([
                    'pet_id' => $pet->id,
                    'user_id' => $admin->id,
                    'weight_at_visit' => $pet->weight,
                    'diagnosis' => 'Revisión general de plumaje y pico.',
                    'treatment' => 'Suplemento de calcio en el agua de bebida por 10 días. Adecuada exposición a luz solar filtrada.',
                    'created_at' => Carbon::now()->subMonths(1),
                    'updated_at' => Carbon::now()->subMonths(1),
                ]);
            }
        }
    }
}
