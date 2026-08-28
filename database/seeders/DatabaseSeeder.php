<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $now = now();

        // Truncate tables to allow fresh seeding
        $driver = DB::getDriverName();
        if ($driver === 'sqlite') {
            DB::statement('PRAGMA foreign_keys = OFF;');
        } else {
            DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        }

        DB::table('users')->truncate();
        DB::table('categories')->truncate();
        DB::table('products')->truncate();
        DB::table('pages')->truncate();
        DB::table('histories')->truncate();
        DB::table('directors')->truncate();
        DB::table('career_jobs')->truncate();
        DB::table('showrooms')->truncate();
        DB::table('button_types')->truncate();
        DB::table('media')->truncate();
        DB::table('settings')->truncate();
        DB::table('cabins')->truncate();
        DB::table('diagnostic_tests')->truncate();
        DB::table('medical_equipments')->truncate();
        DB::table('faqs')->truncate();
        DB::table('health_blogs')->truncate();
        DB::table('blood_banks')->truncate();

        if ($driver === 'sqlite') {
            DB::statement('PRAGMA foreign_keys = ON;');
        } else {
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        }

        // 1. Super Admin User
        DB::table('users')->insert([
            'name' => 'CarePlus Admin',
            'email' => 'admin@alam.com',
            'password' => Hash::make('password'),
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        // 2. Industry Settings
        DB::table('settings')->insert([
            ['key' => 'industry_type', 'value' => 'hospital', 'type' => 'text', 'created_at' => $now, 'updated_at' => $now],
            ['key' => 'site_name', 'value' => 'CarePlus Hospital & Research Center', 'type' => 'text', 'created_at' => $now, 'updated_at' => $now],
            ['key' => 'tagline', 'value' => '24/7 World-Class Healthcare & Emergency Medical Excellence', 'type' => 'text', 'created_at' => $now, 'updated_at' => $now],
            ['key' => 'emergency_phone', 'value' => '+880 1900 123456', 'type' => 'text', 'created_at' => $now, 'updated_at' => $now],
            ['key' => 'ambulance_hotline', 'value' => '10616', 'type' => 'text', 'created_at' => $now, 'updated_at' => $now],
            ['key' => 'factory_video_url', 'value' => 'https://www.youtube.com/embed/LXb3EKWsInQ', 'type' => 'text', 'created_at' => $now, 'updated_at' => $now],
        ]);

        // 3. Categories = Medical Departments & Clinical Specialties (REAL HIGH-RES HOSPITAL PHOTOS)
        DB::table('categories')->insert([
            [
                'name' => 'Cardiology & Heart Center',
                'slug' => 'cardiology-heart-center',
                'description' => 'Comprehensive cardiac diagnostics, angioplasty, open-heart surgery and 24/7 cardiac ICU care.',
                'image' => 'https://images.unsplash.com/photo-1505751172876-fa1923c5c528?auto=format&fit=crop&w=800&q=80',
                'is_active' => 1,
                'sort_order' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Neurology & Neurosurgery',
                'slug' => 'neurology-neurosurgery',
                'description' => 'Advanced treatment for stroke, brain tumors, spine surgery and neuro-rehabilitation.',
                'image' => 'https://images.unsplash.com/photo-1559757175-5700dde675bc?auto=format&fit=crop&w=800&q=80',
                'is_active' => 1,
                'sort_order' => 2,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Orthopedics & Joint Care',
                'slug' => 'orthopedics-joint-care',
                'description' => 'Robotic joint replacement, arthroscopy, spine care and sports injury management.',
                'image' => 'https://images.unsplash.com/photo-1584515979956-d9f6e5d09982?auto=format&fit=crop&w=800&q=80',
                'is_active' => 1,
                'sort_order' => 3,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Pediatrics & Child Health',
                'slug' => 'pediatrics-child-health',
                'description' => 'Specialized pediatric medicine, neonatal ICU (NICU) and pediatric surgery.',
                'image' => 'https://images.unsplash.com/photo-1581594693702-fbdc51b2763b?auto=format&fit=crop&w=800&q=80',
                'is_active' => 1,
                'sort_order' => 4,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Emergency & Trauma Care',
                'slug' => 'emergency-trauma-care',
                'description' => 'Level 1 trauma center with 24/7 emergency physicians, critical care and ambulance fleet.',
                'image' => 'https://images.unsplash.com/photo-1587745416684-47953f16f02f?auto=format&fit=crop&w=800&q=80',
                'is_active' => 1,
                'sort_order' => 5,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Diagnostic & Imaging Lab',
                'slug' => 'diagnostic-imaging-lab',
                'description' => '3T MRI, 128-slice CT scan, digital X-ray, automated pathology and molecular diagnostics.',
                'image' => 'https://images.unsplash.com/photo-1516549655169-df83a0774514?auto=format&fit=crop&w=800&q=80',
                'is_active' => 1,
                'sort_order' => 6,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Oncology & Cancer Institute',
                'slug' => 'oncology-cancer-institute',
                'description' => 'Comprehensive cancer care, chemotherapy, immunotherapy and surgical oncology.',
                'image' => 'https://images.unsplash.com/photo-1579154204601-01588f351e67?auto=format&fit=crop&w=800&q=80',
                'is_active' => 1,
                'sort_order' => 7,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Nephrology & Urology Care',
                'slug' => 'nephrology-urology-care',
                'description' => 'Kidney care, hemodialysis unit, kidney stone laser lithotripsy and urology surgery.',
                'image' => 'https://images.unsplash.com/photo-1576091160399-112ba8d25d1d?auto=format&fit=crop&w=800&q=80',
                'is_active' => 1,
                'sort_order' => 8,
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ]);

        $cardioCatId = DB::table('categories')->where('slug', 'cardiology-heart-center')->value('id') ?? 1;
        $diagCatId = DB::table('categories')->where('slug', 'diagnostic-imaging-lab')->value('id') ?? 6;
        $pediaCatId = DB::table('categories')->where('slug', 'pediatrics-child-health')->value('id') ?? 4;
        $nephroCatId = DB::table('categories')->where('slug', 'nephrology-urology-care')->value('id') ?? 8;

        // 4. Products = Executive Health Screening Packages & Medical Services (REAL MEDICAL PHOTOS)
        DB::table('products')->insert([
            [
                'category_id' => $cardioCatId,
                'name' => 'Master Executive Cardiac Checkup Package',
                'slug' => 'master-executive-cardiac-checkup',
                'description' => 'Comprehensive cardiac evaluation including 2D Echo, TMT Stress Test, ECG, Lipid Profile, Troponin-I and Senior Cardiologist consultation.',
                'specifications' => 'Fasting: 10 hours overnight. Includes 14 diagnostic tests & ECG report.',
                'thumbnail' => 'https://images.unsplash.com/photo-1505751172876-fa1923c5c528?auto=format&fit=crop&w=800&q=80',
                'is_featured' => 1,
                'is_active' => 1,
                'sort_order' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'category_id' => $diagCatId,
                'name' => 'Whole Body Comprehensive Wellness Screening',
                'slug' => 'whole-body-wellness-screening',
                'description' => 'Full body pathology, Ultrasonography, Chest X-ray, Thyroid Profile, Liver & Kidney Function Tests with complimentary breakfast.',
                'specifications' => 'Over 45 lab parameters covered with same-day digital report delivery.',
                'thumbnail' => 'https://images.unsplash.com/photo-1579684385127-1ef15d508118?auto=format&fit=crop&w=800&q=80',
                'is_featured' => 1,
                'is_active' => 1,
                'sort_order' => 2,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'category_id' => $pediaCatId,
                'name' => 'Women Executive Health & Shield Package',
                'slug' => 'women-executive-health-shield',
                'description' => 'Specialized health screening for women including Pap Smear, Mammogram / Breast USG, Bone Mineral Density (BMD), and Gynecologist consultation.',
                'specifications' => 'Includes hormone profile (FSH, LH, TSH) and Vitamin D3 check.',
                'thumbnail' => 'https://images.unsplash.com/photo-1584515979956-d9f6e5d09982?auto=format&fit=crop&w=800&q=80',
                'is_featured' => 1,
                'is_active' => 1,
                'sort_order' => 3,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'category_id' => $nephroCatId,
                'name' => 'Advanced Diabetes & Endocrine Shield Package',
                'slug' => 'advanced-diabetes-endocrine-shield',
                'description' => 'Complete diabetic monitoring including HbA1c, Microalbuminuria, Diabetic Foot Screening, Fundus Eye Checkup, and Endocrinologist consultation.',
                'specifications' => 'Designed for type 1 & type 2 diabetic patients for annual organ risk profiling.',
                'thumbnail' => 'https://images.unsplash.com/photo-1576091160550-2173dba999ef?auto=format&fit=crop&w=800&q=80',
                'is_featured' => 1,
                'is_active' => 1,
                'sort_order' => 4,
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ]);

        // 5. Button Types = Clinical Specialties Showcase (REAL PHOTOS)
        DB::table('button_types')->insert([
            ['name' => 'Interventional Cardiology & Cardiac Surgery', 'variant' => 'four_hole', 'description' => '24/7 Primary Angioplasty (PPCI), Coronary Stenting, Valve Replacement, and Cardiac ICU.', 'image' => 'https://images.unsplash.com/photo-1505751172876-fa1923c5c528?auto=format&fit=crop&w=800&q=80', 'is_active' => 1, 'sort_order' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Micro-Neurosurgery & Spine Care Center', 'variant' => 'two_hole', 'description' => 'Brain tumor removal, stroke neuro-intervention, endoscopic spine surgery & ICU.', 'image' => 'https://images.unsplash.com/photo-1559757175-5700dde675bc?auto=format&fit=crop&w=800&q=80', 'is_active' => 1, 'sort_order' => 2, 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Robotic Joint Replacement & Arthroscopy', 'variant' => 'shank', 'description' => 'Computer-guided total knee and hip replacement with rapid recovery rehab.', 'image' => 'https://images.unsplash.com/photo-1584515979956-d9f6e5d09982?auto=format&fit=crop&w=800&q=80', 'is_active' => 1, 'sort_order' => 3, 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Neonatal Intensive Care (NICU) & Child Health', 'variant' => 'four_hole', 'description' => 'Level 3 NICU care, premature infant support, and pediatric surgical care.', 'image' => 'https://images.unsplash.com/photo-1581594693702-fbdc51b2763b?auto=format&fit=crop&w=800&q=80', 'is_active' => 1, 'sort_order' => 4, 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Comprehensive Cancer Care & Chemotherapy', 'variant' => 'two_hole', 'description' => 'Multidisciplinary tumor board, chemotherapy day-care center & radiation oncology.', 'image' => 'https://images.unsplash.com/photo-1579154204601-01588f351e67?auto=format&fit=crop&w=800&q=80', 'is_active' => 1, 'sort_order' => 5, 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Nephrology, Dialysis & Kidney Transplant', 'variant' => 'shank', 'description' => '24/7 automated hemodialysis unit, kidney stone laser lithotripsy & urology.', 'image' => 'https://images.unsplash.com/photo-1576091160399-112ba8d25d1d?auto=format&fit=crop&w=800&q=80', 'is_active' => 1, 'sort_order' => 6, 'created_at' => $now, 'updated_at' => $now],
        ]);

        // 6. Static Pages
        DB::table('pages')->insert([
            ['title' => 'Mission & Vision', 'slug' => 'mission', 'content' => 'CarePlus Hospital is dedicated to delivering compassionate, patient-centered healthcare with world-class clinical expertise, cutting-edge technology, and zero compromise on patient safety.', 'is_active' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['title' => 'Contact Us', 'slug' => 'contact', 'content' => 'Reach CarePlus Emergency, Helpline & Appointment Desks.', 'is_active' => 1, 'created_at' => $now, 'updated_at' => $now],
        ]);

        // 7. Hospital Milestones & History
        DB::table('histories')->insert([
            ['year' => 2024, 'title' => 'JCI International Accreditation', 'description' => 'Earned Gold Seal of Approval for Patient Safety and Quality Healthcare.', 'sort_order' => 4, 'created_at' => $now, 'updated_at' => $now],
            ['year' => 2020, 'title' => 'Robotic Surgery Wing', 'description' => 'Inaugurated minimally invasive robotic surgical suite.', 'sort_order' => 3, 'created_at' => $now, 'updated_at' => $now],
            ['year' => 2015, 'title' => 'Expanded Organ Transplant Unit', 'description' => 'Established kidney transplant and cardiac critical care units.', 'sort_order' => 2, 'created_at' => $now, 'updated_at' => $now],
            ['year' => 2010, 'title' => 'Hospital Foundation', 'description' => 'CarePlus Hospital opened its 200-bed multi-specialty facility.', 'sort_order' => 1, 'created_at' => $now, 'updated_at' => $now],
        ]);

        // 8. Directors = Specialist Doctors (REAL DOCTOR PORTRAITS)
        DB::table('directors')->insert([
            [
                'name' => 'Dr. Sarah Chen',
                'slug' => 'dr-sarah-chen',
                'designation' => 'Chief Cardiologist & Medical Director',
                'degree' => 'MBBS, FCPS (Cardiology), MD (USA)',
                'specialization' => 'Interventional Cardiology',
                'experience_years' => 20,
                'consultation_fee' => 1500.00,
                'chamber_days' => 'Sat - Wed',
                'chamber_time' => '4:00 PM - 8:00 PM',
                'room_no' => 'Room 302',
                'photo' => 'https://images.unsplash.com/photo-1559839734-2b71ea197ec2?auto=format&fit=crop&w=800&q=80',
                'bio' => 'Dr. Sarah Chen is an internationally trained interventional cardiologist with over 20 years of experience in angioplasty, heart failure management, and preventive cardiac care.',
                'is_active' => 1,
                'sort_order' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Dr. Samir Sven',
                'slug' => 'dr-samir-sven',
                'designation' => 'Senior Neurosurgeon & Head of Neurosurgery',
                'degree' => 'MBBS, MS (Neurosurgery), Fellowship (UK)',
                'specialization' => 'Micro-Neurosurgery & Spine',
                'experience_years' => 18,
                'consultation_fee' => 1800.00,
                'chamber_days' => 'Sun - Thu',
                'chamber_time' => '5:00 PM - 9:00 PM',
                'room_no' => 'Room 405',
                'photo' => 'https://images.unsplash.com/photo-1622253692010-333f2da6031d?auto=format&fit=crop&w=800&q=80',
                'bio' => 'Dr. Samir Sven specializes in complex brain tumor resections, minimally invasive spine surgery, and acute stroke neuro-interventions.',
                'is_active' => 1,
                'sort_order' => 2,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Dr. Nusrat Jahan',
                'slug' => 'dr-nusrat-jahan',
                'designation' => 'Professor of Pediatrics & NICU In-Charge',
                'degree' => 'MBBS, DCH, FCPS (Pediatrics)',
                'specialization' => 'Neonatology & Child Health',
                'experience_years' => 16,
                'consultation_fee' => 1200.00,
                'chamber_days' => 'Sat - Thu',
                'chamber_time' => '3:00 PM - 7:00 PM',
                'room_no' => 'Room 201',
                'photo' => 'https://images.unsplash.com/photo-1651008376811-b90baee60c1f?auto=format&fit=crop&w=800&q=80',
                'bio' => 'Dr. Nusrat Jahan is a renowned pediatrician specializing in neonatal intensive care (NICU), pediatric nutrition, and childhood immunization.',
                'is_active' => 1,
                'sort_order' => 3,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Dr. Tanvir Ahmed',
                'slug' => 'dr-tanvir-ahmed',
                'designation' => 'Senior Orthopedic & Joint Surgeon',
                'degree' => 'MBBS, MS (Orthopedics)',
                'specialization' => 'Robotic Joint Replacement',
                'experience_years' => 15,
                'consultation_fee' => 1400.00,
                'chamber_days' => 'Mon - Sat',
                'chamber_time' => '4:30 PM - 8:30 PM',
                'room_no' => 'Room 308',
                'photo' => 'https://images.unsplash.com/photo-1612349317150-e413f6a5b16d?auto=format&fit=crop&w=800&q=80',
                'bio' => 'Dr. Tanvir Ahmed is an expert in computer-assisted robotic knee and hip replacement surgery, arthroscopy, and complex fracture trauma.',
                'is_active' => 1,
                'sort_order' => 4,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Dr. Ananya Roy',
                'slug' => 'dr-ananya-roy',
                'designation' => 'Senior Medical Oncologist & Cancer Specialist',
                'degree' => 'MBBS, MD (Oncology), MRCP (UK)',
                'specialization' => 'Medical Oncology & Immunotherapy',
                'experience_years' => 14,
                'consultation_fee' => 1600.00,
                'chamber_days' => 'Sun - Wed',
                'chamber_time' => '3:30 PM - 7:30 PM',
                'room_no' => 'Room 504',
                'photo' => 'https://images.unsplash.com/photo-1559839734-2b71ea197ec2?auto=format&fit=crop&w=800&q=80',
                'bio' => 'Dr. Ananya Roy specializes in targeted cancer therapies, chemotherapy protocol management, and breast & lung cancer oncology.',
                'is_active' => 1,
                'sort_order' => 5,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Dr. Kazi Rahman',
                'slug' => 'dr-kazi-rahman',
                'designation' => 'Head of Nephrology & Kidney Transplant',
                'degree' => 'MBBS, MD (Nephrology), FCPS',
                'specialization' => 'Nephrology & Renal Transplant',
                'experience_years' => 19,
                'consultation_fee' => 1500.00,
                'chamber_days' => 'Sat - Thu',
                'chamber_time' => '5:00 PM - 9:00 PM',
                'room_no' => 'Room 410',
                'photo' => 'https://images.unsplash.com/photo-1537368910025-700350fe46c7?auto=format&fit=crop&w=800&q=80',
                'bio' => 'Dr. Kazi Rahman is an authority in kidney disease management, chronic dialysis care, and living donor renal transplantation.',
                'is_active' => 1,
                'sort_order' => 6,
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ]);

        // 9. Cabins & Ward Daily Rent Rates (REAL HOSPITAL CABIN PHOTOS)
        DB::table('cabins')->insert([
            ['name' => 'VIP Presidential Suite #501', 'room_type' => 'VIP Cabin', 'rent_per_day' => 12000.00, 'amenities' => 'AC, LED TV, Refrigerator, Attached Bath, Attendant Sofa-Bed, Dining Area, Electric Patient Bed', 'image' => 'https://images.unsplash.com/photo-1586773860418-d37222d8fce3?auto=format&fit=crop&w=800&q=80', 'is_available' => 1, 'is_active' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Super Deluxe Cabin #402', 'room_type' => 'Deluxe Cabin', 'rent_per_day' => 8500.00, 'amenities' => 'AC, LED TV, Attached Bath, Fridge, Attendant Bed, 24/7 Nursing Call', 'image' => 'https://images.unsplash.com/photo-1512678080530-7760d81faba6?auto=format&fit=crop&w=800&q=80', 'is_available' => 1, 'is_active' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Single Executive Cabin #305', 'room_type' => 'Single Cabin', 'rent_per_day' => 5500.00, 'amenities' => 'AC, LED TV, Attached Bath, Attendant Chair, Oxygen Outlet', 'image' => 'https://images.unsplash.com/photo-1519494026892-80bbd2d6fd0d?auto=format&fit=crop&w=800&q=80', 'is_available' => 1, 'is_active' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Critical ICU Bed Suite', 'room_type' => 'ICU Bed', 'rent_per_day' => 15000.00, 'amenities' => 'Advanced Mechanical Ventilator, Multi-Para Patient Monitor, Syringe Pump, Central Oxygen', 'image' => 'https://images.unsplash.com/photo-1516549655169-df83a0774514?auto=format&fit=crop&w=800&q=80', 'is_available' => 1, 'is_active' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'CCU Cardiac Intensive Care Suite', 'room_type' => 'ICU Bed', 'rent_per_day' => 14000.00, 'amenities' => 'Continuous ECG Monitoring, Defibrillator, Intra-Aortic Balloon Pump Support, 24/7 Cardiac Nurse', 'image' => 'https://images.unsplash.com/photo-1504813184591-01572f98c85f?auto=format&fit=crop&w=800&q=80', 'is_available' => 1, 'is_active' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Twin Sharing Standard Cabin #204', 'room_type' => 'Single Cabin', 'rent_per_day' => 3500.00, 'amenities' => 'AC, Shared TV, Curtain Privacy Divider, Attendant Chair, Nurse Call Bell', 'image' => 'https://images.unsplash.com/photo-1586773860418-d37222d8fce3?auto=format&fit=crop&w=800&q=80', 'is_available' => 1, 'is_active' => 1, 'created_at' => $now, 'updated_at' => $now],
        ]);

        // 10. Diagnostic Tests & Price List
        DB::table('diagnostic_tests')->insert([
            ['name' => 'Complete Blood Count (CBC) with ESR', 'code' => 'CBC-101', 'category_name' => 'Hematology Lab', 'price' => 650.00, 'description' => 'Complete blood count analysis including hemoglobin, WBC, RBC & platelet parameters.', 'preparation_instructions' => 'Fasting not strictly required.', 'is_active' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['name' => '3T MRI Brain with Contrast', 'code' => 'MRI-302', 'category_name' => 'Radiology & MRI', 'price' => 9500.00, 'description' => 'High-resolution 3-Tesla magnetic resonance imaging of brain parenchyma.', 'preparation_instructions' => 'Remove all metallic objects and jewelry.', 'is_active' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['name' => '128-Slice CT Coronary Angiogram', 'code' => 'CT-204', 'category_name' => 'Cardiology Imaging', 'price' => 12500.00, 'description' => 'Non-invasive 3D imaging of heart coronary arteries to detect blockages.', 'preparation_instructions' => '4 hours fasting required. Serum creatinine report needed.', 'is_active' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Color Doppler Echocardiogram (2D Echo)', 'code' => 'ECHO-105', 'category_name' => 'Cardiac Lab', 'price' => 3500.00, 'description' => 'Ultrasound of the heart to evaluate valve function and ejection fraction.', 'preparation_instructions' => 'No special preparation needed.', 'is_active' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Fasting Blood Sugar (FBS) & Lipid Profile', 'code' => 'BIO-401', 'category_name' => 'Biochemistry Lab', 'price' => 1200.00, 'description' => 'Glucose and cholesterol panel measuring HDL, LDL, and triglycerides.', 'preparation_instructions' => '10-12 hours overnight fasting mandatory.', 'is_active' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'High-Sensitivity Troponin-I Cardiac Marker', 'code' => 'TROP-109', 'category_name' => 'Cardiac Emergency Lab', 'price' => 1800.00, 'description' => 'Rapid quantitative cardiac troponin assay for acute myocardial infarction diagnosis.', 'preparation_instructions' => 'Stat emergency blood sample.', 'is_active' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Whole Abdomen Ultrasonography (USG)', 'code' => 'USG-201', 'category_name' => 'Ultrasonography', 'price' => 2200.00, 'description' => 'High-frequency 4D ultrasound scan of liver, gallbladder, pancreas, kidneys & bladder.', 'preparation_instructions' => '6 hours fasting & full urinary bladder required.', 'is_active' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Thyroid Profile (T3, T4, TSH)', 'code' => 'THY-301', 'category_name' => 'Hormone & Endocrine Lab', 'price' => 1500.00, 'description' => 'Quantitative serum thyroid hormone immunoassay panel.', 'preparation_instructions' => 'Morning blood sample recommended.', 'is_active' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Renal Function Test (RFT / KFT)', 'code' => 'RFT-402', 'category_name' => 'Biochemistry Lab', 'price' => 1100.00, 'description' => 'Serum Creatinine, Urea, Uric Acid, Electrolytes (Na, K, Cl).', 'preparation_instructions' => 'Fasting preferred.', 'is_active' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'HbA1c Glycated Hemoglobin Test', 'code' => 'HBA1C-501', 'category_name' => 'Biochemistry Lab', 'price' => 950.00, 'description' => 'Gold standard 3-month average blood glucose control indicator.', 'preparation_instructions' => 'Fasting not required.', 'is_active' => 1, 'created_at' => $now, 'updated_at' => $now],
        ]);

        // 11. Medical Machinery & Equipments (REAL HIGH-RES MEDICAL MACHINERY PHOTOS)
        DB::table('medical_equipments')->insert([
            ['name' => 'Siemens Magnetom Vida 3T MRI Scanner', 'model_name' => 'MAGNETOM Vida 3T', 'department_name' => 'Radiology & Imaging', 'description' => 'Biomatrix technology 3T MRI providing ultra-fast scans with exceptional image resolution.', 'image' => 'https://images.unsplash.com/photo-1516549655169-df83a0774514?auto=format&fit=crop&w=800&q=80', 'is_active' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'GE Revolution 128-Slice CT Scanner', 'model_name' => 'Revolution EVO', 'department_name' => 'CT Scan Division', 'description' => 'Ultra-low dose cardiac and whole-body 3D CT scanner.', 'image' => 'https://images.unsplash.com/photo-1579684385127-1ef15d508118?auto=format&fit=crop&w=800&q=80', 'is_active' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'da Vinci Xi Robotic Surgical Suite', 'model_name' => 'da Vinci Xi System', 'department_name' => 'Robotic Surgery Wing', 'description' => '3D HD vision robotic surgical arm for minimally invasive urology, gynecology, and cardiac surgery.', 'image' => 'https://images.unsplash.com/photo-1551076805-e1869033e561?auto=format&fit=crop&w=800&q=80', 'is_active' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Philips Azurion 7 Cardiac Catheterization Lab', 'model_name' => 'Azurion 7 C20', 'department_name' => 'Interventional Cardiology', 'description' => 'ClarityIQ ultra-low X-ray dose angiogram catheterization lab for 24/7 angioplasty.', 'image' => 'https://images.unsplash.com/photo-1519494026892-80bbd2d6fd0d?auto=format&fit=crop&w=800&q=80', 'is_active' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Dräger Perseus A500 Anesthesia Workstation', 'model_name' => 'Perseus A500', 'department_name' => 'Operation Theatre Wing', 'description' => 'Advanced ventilation and gas monitoring anesthesia suite for high-risk surgical ICU.', 'image' => 'https://images.unsplash.com/photo-1586773860418-d37222d8fce3?auto=format&fit=crop&w=800&q=80', 'is_active' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Olympus EVIS X1 Video Endoscopy System', 'model_name' => 'EVIS X1 CV-1500', 'department_name' => 'Gastroenterology Lab', 'description' => 'HD narrow band imaging (NBI) endoscopy for early detection of GI tract lesions.', 'image' => 'https://images.unsplash.com/photo-1579154204601-01588f351e67?auto=format&fit=crop&w=800&q=80', 'is_active' => 1, 'created_at' => $now, 'updated_at' => $now],
        ]);

        // 12. Emergency Blood Bank Stock
        DB::table('blood_banks')->insert([
            ['blood_group' => 'A+', 'units_available' => 15, 'last_updated' => 'Today 10:00 AM', 'contact_number' => '1-800-CARE-NOW', 'is_active' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['blood_group' => 'O+', 'units_available' => 22, 'last_updated' => 'Today 10:00 AM', 'contact_number' => '1-800-CARE-NOW', 'is_active' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['blood_group' => 'B+', 'units_available' => 18, 'last_updated' => 'Today 10:00 AM', 'contact_number' => '1-800-CARE-NOW', 'is_active' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['blood_group' => 'AB+', 'units_available' => 8, 'last_updated' => 'Today 10:00 AM', 'contact_number' => '1-800-CARE-NOW', 'is_active' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['blood_group' => 'O-', 'units_available' => 5, 'last_updated' => 'Today 10:00 AM', 'contact_number' => '1-800-CARE-NOW', 'is_active' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['blood_group' => 'B-', 'units_available' => 4, 'last_updated' => 'Today 10:00 AM', 'contact_number' => '1-800-CARE-NOW', 'is_active' => 1, 'created_at' => $now, 'updated_at' => $now],
        ]);

        // 13. Patient FAQs
        DB::table('faqs')->insert([
            ['question' => 'How can I book an appointment with a specialist doctor?', 'answer' => 'You can book online by selecting your preferred doctor from our Featured Doctors list, choosing your preferred date, and getting an instant serial token.', 'category' => 'OPD & Appointments', 'sort_order' => 1, 'is_active' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['question' => 'What are the visiting hours for inpatients in Cabins & ICU?', 'answer' => 'Cabin visiting hours are 4:00 PM – 7:00 PM daily. ICU visiting hours are strictly restricted to 5:00 PM – 6:00 PM for one primary attendant.', 'category' => 'Cabins & Admission', 'sort_order' => 2, 'is_active' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['question' => 'Are emergency services and ICU ambulances open 24/7?', 'answer' => 'Yes, our 24/7 Casualty Emergency Desk and ICU Ambulance fleet operate round-the-clock. Call 1-800-CARE-NOW for immediate dispatch.', 'category' => 'Emergency & ICU', 'sort_order' => 3, 'is_active' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['question' => 'How do I get discount on diagnostic test rates?', 'answer' => 'Use our online Diagnostic Test Price List calculator to apply 5%, 10%, 15%, or 20% Health Card discounts before booking.', 'category' => 'Diagnostics & Reports', 'sort_order' => 4, 'is_active' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['question' => 'What insurance cards & corporate health networks are accepted?', 'answer' => 'We accept all major health insurance policies including Square Health, Apollo Network, MetLife, Green Delta, Pragati, and corporate cashless desks.', 'category' => 'Insurance & Billing', 'sort_order' => 5, 'is_active' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['question' => 'How can I receive my pathology & radiology test reports online?', 'answer' => 'Once your test report is verified by senior pathologists, a secure SMS download link is sent directly to your registered mobile phone number.', 'category' => 'Diagnostics & Reports', 'sort_order' => 6, 'is_active' => 1, 'created_at' => $now, 'updated_at' => $now],
        ]);

        // 14. Health Articles & Medical Tips (REAL PHOTOS)
        DB::table('health_blogs')->insert([
            [
                'title' => '10 Essential Tips for Healthy Heart & BP Management',
                'slug' => '10-tips-healthy-heart',
                'author' => 'Dr. Sarah Chen (Chief Cardiologist)',
                'category' => 'Cardiology & Heart Care',
                'content' => 'Preventive cardiac care starts with daily 30-minute aerobic walking, low sodium intake, stress management, and regular lipid profile testing after age 35.',
                'image' => 'https://images.unsplash.com/photo-1505751172876-fa1923c5c528?auto=format&fit=crop&w=800&q=80',
                'published_at' => now()->toDateString(),
                'is_active' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'title' => 'Understanding Early Symptoms of Stroke & Emergency Care',
                'slug' => 'stroke-symptoms-emergency-care',
                'author' => 'Dr. Samir Sven (Head of Neurosurgery)',
                'category' => 'Neurology & Brain Health',
                'content' => 'Remember the FAST rule for stroke: Facial drooping, Arm weakness, Speech difficulty, and Time to call 24/7 Emergency. Golden hour treatment saves lives.',
                'image' => 'https://images.unsplash.com/photo-1559757175-5700dde675bc?auto=format&fit=crop&w=800&q=80',
                'published_at' => now()->toDateString(),
                'is_active' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'title' => 'Childhood Immunization Schedule & Infant Nutrition Guide',
                'slug' => 'childhood-immunization-infant-nutrition',
                'author' => 'Dr. Nusrat Jahan (Professor of Pediatrics)',
                'category' => 'Pediatrics & Child Care',
                'content' => 'Ensure timely vaccination from birth. Exclusive breastfeeding for the first 6 months builds strong natural immunity against seasonal infections.',
                'image' => 'https://images.unsplash.com/photo-1581594693702-fbdc51b2763b?auto=format&fit=crop&w=800&q=80',
                'published_at' => now()->toDateString(),
                'is_active' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'title' => 'Preventing Joint Pain: Early Signs of Osteoarthritis & Care',
                'slug' => 'preventing-joint-pain-osteoarthritis',
                'author' => 'Dr. Tanvir Ahmed (Senior Orthopedic Surgeon)',
                'category' => 'Orthopedics & Joint Care',
                'content' => 'Maintain healthy joint cartilage with quadriceps strengthening exercises, weight management, and early consultation for knee stiffness.',
                'image' => 'https://images.unsplash.com/photo-1584515979956-d9f6e5d09982?auto=format&fit=crop&w=800&q=80',
                'published_at' => now()->toDateString(),
                'is_active' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'title' => 'Kidney Stone Symptoms & Modern Laser Lithotripsy',
                'slug' => 'kidney-stone-symptoms-laser-lithotripsy',
                'author' => 'Dr. Kazi Rahman (Head of Nephrology)',
                'category' => 'Nephrology & Urology',
                'content' => 'Stay hydrated with 3 liters of water daily. Modern RIRS laser lithotripsy removes kidney stones completely without any surgical cuts.',
                'image' => 'https://images.unsplash.com/photo-1576091160399-112ba8d25d1d?auto=format&fit=crop&w=800&q=80',
                'published_at' => now()->toDateString(),
                'is_active' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'title' => 'Managing Diabetes: Dietary Control, Exercise & HbA1c Target',
                'slug' => 'managing-diabetes-diet-exercise-hba1c',
                'author' => 'Dr. Ananya Roy (Senior Medical Oncologist)',
                'category' => 'Endocrinology & Wellness',
                'content' => 'Keep your HbA1c below 7.0%. Balanced portion control, glycemic index management, and annual organ checkups ensure a healthy life.',
                'image' => 'https://images.unsplash.com/photo-1576091160550-2173dba999ef?auto=format&fit=crop&w=800&q=80',
                'published_at' => now()->toDateString(),
                'is_active' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ]);

        // 15. Career Jobs = Medical & Administrative Vacancies
        DB::table('career_jobs')->insert([
            [
                'title' => 'Senior Resident Medical Officer (Emergency)',
                'slug' => 'senior-rmo-emergency',
                'description' => 'Manage emergency patients, triage trauma cases, and coordinate emergency procedures.',
                'requirements' => 'MBBS with 3+ years experience in Emergency Medicine or ICU.',
                'location' => 'Dhaka Main Hospital',
                'type' => 'Full-time',
                'is_active' => 1,
                'sort_order' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'title' => 'Staff Nurse (ICU & Critical Care)',
                'slug' => 'staff-nurse-icu',
                'description' => 'Provide intensive care nursing for critically ill cardiac and neuro patients.',
                'requirements' => 'B.Sc / Diploma in Nursing with 2+ years ICU experience.',
                'location' => 'Dhaka Main Hospital',
                'type' => 'Full-time',
                'is_active' => 1,
                'sort_order' => 2,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'title' => 'Consultant Radiologist (3T MRI & 128-Slice CT)',
                'slug' => 'consultant-radiologist-mri-ct',
                'description' => 'Interpret 3T MRI, cardiac CT angiograms and supervise diagnostic imaging staff.',
                'requirements' => 'MD / FCPS in Radiology & Imaging with 5+ years experience.',
                'location' => 'Gulshan OPD Campus',
                'type' => 'Full-time',
                'is_active' => 1,
                'sort_order' => 3,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'title' => 'Executive Patient Care & Admission Coordinator',
                'slug' => 'executive-patient-care-coordinator',
                'description' => 'Assist patient admissions, manage VIP cabin reservations, and handle patient feedback.',
                'requirements' => 'Bachelor degree with fluent English & Bengali communication skills.',
                'location' => 'Uttara Main Campus',
                'type' => 'Full-time',
                'is_active' => 1,
                'sort_order' => 4,
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ]);

        // 16. Showrooms = Hospital Campuses & Outpatient Clinics
        DB::table('showrooms')->insert([
            [
                'name' => 'CarePlus Main Hospital & Emergency Center',
                'slug' => 'careplus-main-hospital',
                'description' => '24/7 Multi-Specialty Hospital, Emergency ER, ICU, CCU and Diagnostic Center.',
                'address' => 'Plot 12, Medical Zone, Gulshan-2, Dhaka 1212',
                'phone' => '+880 1900 123456',
                'email' => 'emergency@careplushospital.com',
                'is_active' => 1,
                'sort_order' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'CarePlus Specialist Outpatient Clinic - Dhanmondi',
                'slug' => 'careplus-outpatient-clinic-dhanmondi',
                'description' => 'Outpatient consultations, doctor chambers, specialist clinics & wellness checkups.',
                'address' => 'House 45, Road 7, Dhanmondi, Dhaka 1205',
                'phone' => '+880 1700 987654',
                'email' => 'opd.dhanmondi@careplushospital.com',
                'is_active' => 1,
                'sort_order' => 2,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'CarePlus Diagnostic & Consultation Hub - Uttara',
                'slug' => 'careplus-diagnostic-hub-uttara',
                'description' => 'Sample collection center, digital 3T MRI, 128-slice CT scan, and specialist OPD chambers.',
                'address' => 'Sector 7, Main Medical Drive, Uttara, Dhaka 1230',
                'phone' => '+880 1800 555666',
                'email' => 'uttara@careplushospital.com',
                'is_active' => 1,
                'sort_order' => 3,
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ]);

        // 17. Media = Hero Slider, Accreditations, Gallery & Insurance Partners (REAL BRAND & GALLERY PHOTOS)
        DB::table('media')->insert([
            ['title' => 'JCI International Accredited Hospital', 'type' => 'certification', 'file_path' => '', 'url' => '', 'alt' => 'JCI Accredited Hospital', 'sort_order' => 1, 'is_active' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['title' => 'ISO 9001:2015 Healthcare Certified', 'type' => 'certification', 'file_path' => '', 'url' => '', 'alt' => 'ISO 9001 Certified', 'sort_order' => 2, 'is_active' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['title' => 'BMDC Recognized Specialist Center', 'type' => 'certification', 'file_path' => '', 'url' => '', 'alt' => 'BMDC Recognized', 'sort_order' => 3, 'is_active' => 1, 'created_at' => $now, 'updated_at' => $now],
            
            // Insurance Partners (type = 'brand')
            ['title' => 'Square Health Group', 'type' => 'brand', 'file_path' => '', 'url' => 'https://images.unsplash.com/photo-1618005182384-a83a8bd57fbe?auto=format&fit=crop&w=400&q=80', 'alt' => 'Square Health Partner', 'sort_order' => 1, 'is_active' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['title' => 'Apollo Medical Network', 'type' => 'brand', 'file_path' => '', 'url' => 'https://images.unsplash.com/photo-1576091160399-112ba8d25d1d?auto=format&fit=crop&w=400&q=80', 'alt' => 'Apollo Network', 'sort_order' => 2, 'is_active' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['title' => 'Global Health Insurance Alliance', 'type' => 'brand', 'file_path' => '', 'url' => 'https://images.unsplash.com/photo-1505751172876-fa1923c5c528?auto=format&fit=crop&w=400&q=80', 'alt' => 'Global Health Insurance', 'sort_order' => 3, 'is_active' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['title' => 'MetLife Healthcare Network', 'type' => 'brand', 'file_path' => '', 'url' => 'https://images.unsplash.com/photo-1516549655169-df83a0774514?auto=format&fit=crop&w=400&q=80', 'alt' => 'MetLife Health', 'sort_order' => 4, 'is_active' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['title' => 'Green Delta Insurance Desk', 'type' => 'brand', 'file_path' => '', 'url' => 'https://images.unsplash.com/photo-1586773860418-d37222d8fce3?auto=format&fit=crop&w=400&q=80', 'alt' => 'Green Delta Insurance', 'sort_order' => 5, 'is_active' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['title' => 'Pragati Life Cashless Network', 'type' => 'brand', 'file_path' => '', 'url' => 'https://images.unsplash.com/photo-1519494026892-80bbd2d6fd0d?auto=format&fit=crop&w=400&q=80', 'alt' => 'Pragati Life', 'sort_order' => 6, 'is_active' => 1, 'created_at' => $now, 'updated_at' => $now],
            
            // Hospital Gallery (type = 'gallery')
            ['title' => 'Advanced Robotic Surgery Suite', 'type' => 'gallery', 'file_path' => '', 'url' => 'https://images.unsplash.com/photo-1551076805-e1869033e561?auto=format&fit=crop&w=800&q=80', 'alt' => 'Robotic Suite', 'sort_order' => 1, 'is_active' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['title' => '3.0T MRI Scanner Facility', 'type' => 'gallery', 'file_path' => '', 'url' => 'https://images.unsplash.com/photo-1516549655169-df83a0774514?auto=format&fit=crop&w=800&q=80', 'alt' => 'MRI Facility', 'sort_order' => 2, 'is_active' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['title' => 'Cardiac ICU & Critical Care Unit', 'type' => 'gallery', 'file_path' => '', 'url' => 'https://images.unsplash.com/photo-1519494026892-80bbd2d6fd0d?auto=format&fit=crop&w=800&q=80', 'alt' => 'Cardiac ICU', 'sort_order' => 3, 'is_active' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['title' => 'Executive Patient Lounge', 'type' => 'gallery', 'file_path' => '', 'url' => 'https://images.unsplash.com/photo-1586773860418-d37222d8fce3?auto=format&fit=crop&w=800&q=80', 'alt' => 'Executive Lounge', 'sort_order' => 4, 'is_active' => 1, 'created_at' => $now, 'updated_at' => $now],
        ]);
    }
}