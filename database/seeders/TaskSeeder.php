<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TaskSeeder extends Seeder
{
    /**
     * Seed the tasks table with demo project tasks.
     */
    public function run(): void
    {
        $statements = [
            "INSERT OR REPLACE INTO tasks (id, task_code, task_name, task_description, work_time, company_profile_id, activity_type_id, task_status_id, created_at, updated_at) VALUES (1, 'TASK-001', 'Izrada korisničkog modula', 'Razviti modul za upravljanje korisnicima, ulogama i pravima pristupa.', 8, 1, 1, 2, '2026-06-11 09:07:51', '2026-06-11 09:07:51')",
            "INSERT OR REPLACE INTO tasks (id, task_code, task_name, task_description, work_time, company_profile_id, activity_type_id, task_status_id, created_at, updated_at) VALUES (2, 'TASK-002', 'Implementacija prijave u sustav', 'Izraditi funkcionalnost prijave korisnika s osnovnom validacijom podataka.', 6, 1, 1, 4, '2026-06-11 09:07:51', '2026-06-11 09:07:51')",
            "INSERT OR REPLACE INTO tasks (id, task_code, task_name, task_description, work_time, company_profile_id, activity_type_id, task_status_id, created_at, updated_at) VALUES (3, 'TASK-003', 'Testiranje forme za unos podataka', 'Provesti funkcionalno testiranje forme za unos i izmjenu podataka.', 3, 1, 2, 1, '2026-06-11 09:07:51', '2026-06-11 09:07:51')",
            "INSERT OR REPLACE INTO tasks (id, task_code, task_name, task_description, work_time, company_profile_id, activity_type_id, task_status_id, created_at, updated_at) VALUES (4, 'TASK-004', 'Rješavanje korisničke prijave', 'Analizirati i riješiti prijavu korisnika vezanu uz neispravan prikaz podataka.', 2, 1, 3, 3, '2026-06-11 09:07:51', '2026-06-11 09:07:51')",
            "INSERT OR REPLACE INTO tasks (id, task_code, task_name, task_description, work_time, company_profile_id, activity_type_id, task_status_id, created_at, updated_at) VALUES (5, 'TASK-005', 'Ažuriranje poslužitelja', 'Instalirati sigurnosna ažuriranja i provjeriti stabilnost poslužitelja nakon nadogradnje.', 4, 1, 4, 2, '2026-06-11 09:07:51', '2026-06-11 09:07:51')",
            "INSERT OR REPLACE INTO tasks (id, task_code, task_name, task_description, work_time, company_profile_id, activity_type_id, task_status_id, created_at, updated_at) VALUES (6, 'TASK-006', 'Provjera mrežne povezanosti', 'Provjeriti dostupnost mrežnih uređaja i stabilnost interne mreže.', 2.5, 1, 5, 5, '2026-06-11 09:07:51', '2026-06-11 09:07:51')",
            "INSERT OR REPLACE INTO tasks (id, task_code, task_name, task_description, work_time, company_profile_id, activity_type_id, task_status_id, created_at, updated_at) VALUES (7, 'TASK-007', 'Sigurnosna analiza aplikacije', 'Pregledati osnovne sigurnosne postavke aplikacije i evidentirati potencijalne rizike.', 5, 1, 6, 1, '2026-06-11 09:07:51', '2026-06-11 09:07:51')",
            "INSERT OR REPLACE INTO tasks (id, task_code, task_name, task_description, work_time, company_profile_id, activity_type_id, task_status_id, created_at, updated_at) VALUES (8, 'TASK-008', 'Optimizacija baze podataka', 'Analizirati spore upite i dodati potrebne indekse radi bolje izvedbe.', 4, 1, 7, 2, '2026-06-11 09:07:51', '2026-06-11 09:07:51')",
            "INSERT OR REPLACE INTO tasks (id, task_code, task_name, task_description, work_time, company_profile_id, activity_type_id, task_status_id, created_at, updated_at) VALUES (9, 'TASK-009', 'Postavljanje CI/CD procesa', 'Konfigurirati automatiziranu izgradnju i isporuku aplikacije na testno okruženje.', 7, 1, 8, 3, '2026-06-11 09:07:51', '2026-06-11 09:07:51')",
            "INSERT OR REPLACE INTO tasks (id, task_code, task_name, task_description, work_time, company_profile_id, activity_type_id, task_status_id, created_at, updated_at) VALUES (10, 'TASK-010', 'Izrada projektnog plana', 'Definirati projektne aktivnosti, rokove, odgovorne osobe i ključne isporuke.', 3, 1, 9, 5, '2026-06-11 09:07:51', '2026-06-11 09:07:51')",
            "INSERT OR REPLACE INTO tasks (id, task_code, task_name, task_description, work_time, company_profile_id, activity_type_id, task_status_id, created_at, updated_at) VALUES (11, 'TASK-011', 'Izrada tehničke dokumentacije', 'Dokumentirati strukturu aplikacije, glavne module i način pokretanja sustava.', 4, 1, 10, 2, '2026-06-11 09:07:51', '2026-06-11 09:07:51')",
            "INSERT OR REPLACE INTO tasks (id, task_code, task_name, task_description, work_time, company_profile_id, activity_type_id, task_status_id, created_at, updated_at) VALUES (12, 'TASK-012', 'Ispravak greške u izvještajima', 'Pronaći i ispraviti grešku zbog koje se izvještaji ne prikazuju ispravno.', 3.5, 1, 1, 4, '2026-06-11 09:07:51', '2026-06-11 09:07:51')",
        ];

        foreach ($statements as $statement) {
            DB::statement($statement);
        }
    }
}
