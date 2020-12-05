<?php

use Illuminate\Database\Seeder;

class ReasonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $reasons = [ 
            "Annual Physical",
            "General Consultation",
            "Illness",
            "Infection Consultation",
            "New Patient Visit",
            "Acid Reflux / Heartburn",
            "Anemia",
            "Back Problems",
            "Bleeding Disorder",
            "Blood Pressure Testing",
            "Blood Work",
            "Bronchitis",
            "COVID-19 Antibody Test",
            "Chlamydia",
            "Cholesterol / Lipids Checkup",
            "Cholesterol Management",
            "Chronic Cough",
            "Chronic Illness",
            "Cold",
            "Cold Sores / Herpes Labialis",
            "Constipation",
            "Cough",
            "Diabetes Consultation",
            "ECG / EKG",
            "Ear Infection",
            "Electrocardiogram",
            "Elevated PSA",
            "Enlarged Lymph Nodes",
            "Erectile Dysfunction / Impotence / Male Sexual Dysfunction",
            "Eye Infection",
            "Fainting / Syncope",
            "Fatty Liver Disease",
            "Flu",
            "Frequent Urination",
            "General Follow Up",
            "Headache",
            "High Blood Pressure / Hypertension",
            "High Blood Sugar / Hyperglycemia",
            "High Cholesterol / Lipid Problem",
            "Hospital Discharge/Follow Up",
            "Hyperlipidemia",
            "Hyperthyroidism / Overactive Thyroid",
            "Hypogonadism",
            "Hypothyroidism / Underactive Thyroid",
            "Immigration Medical Examination",
            "Immunization",
            "Immunodeficiency",
            "Infection Follow Up",
            "Insomnia",
            "Iron Deficiency",
            "Kidney Stones",
            "Medication Review",
            "Migraine",
            "Nasal Congestion",
            "Pre-Surgery Checkup / Pre-Surgical Clearance",
            "Prescription / Refill",
            "Preventive Medicine Consultation",
            "Sexually Transmitted Disease (STD)",
            "Sleep Disorder",
            "Sore Throat",
            "Swelling in Neck",
            "Thyroid Evaluation",
            "Tiredness / Fatigue",
            "Type 2 Diabetes",
            "Urinary Urgency / Urge Incontinence",
        ];
    
    
        foreach ($reasons as $reason) {
            DB::table('reasons')->insert([
                'name' => $reason,
                'created_at'=>date('Y-m-d H:i:s'),
                'updated_at'=>date('Y-m-d H:i:s'), 
            ]);  
        }
    }
}
