<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\History;
use App\Models\Director;
use App\Models\Page;
use App\Models\Media;
use App\Models\Setting;
use App\Models\Cabin;
use App\Models\DiagnosticTest;
use App\Models\MedicalEquipment;
use App\Models\ButtonType;
use App\Models\CustomOrder;
use App\Models\Faq;
use App\Models\HealthBlog;
use App\Models\BloodBank;
use Illuminate\Http\Request;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function switchLanguage(string $locale)
    {
        if (in_array($locale, ['en', 'bn'])) {
            session(['locale' => $locale]);
        }
        return back();
    }

    public function index(): View
    {
        $categories = Category::where('is_active', true)->orderBy('sort_order')->get();
        $featuredProducts = \App\Models\Product::where('is_featured', true)->where('is_active', true)->with('category')->take(6)->get();
        $latestJobs = \App\Models\Job::where('is_active', true)->orderBy('created_at', 'desc')->take(3)->get();
        $showrooms = \App\Models\Showroom::where('is_active', true)->orderBy('sort_order')->take(3)->get();
        $slider = Media::where('type', 'slider')->where('is_active', true)->orderBy('sort_order')->get();
        $buttonTypes = ButtonType::where('is_active', true)->orderBy('sort_order')->get();
        $certifications = Media::where('type', 'certification')->where('is_active', true)->orderBy('sort_order')->get();
        $brands = Media::where('type', 'brand')->where('is_active', true)->orderBy('sort_order')->get();
        $gallery = Media::where('type', 'gallery')->where('is_active', true)->orderBy('sort_order')->get();
        $directors = Director::where('is_active', true)->orderBy('sort_order')->take(6)->get();
        
        // Auto convert ANY YouTube watch / share link to valid embed link
        $rawVideoUrl = Setting::get('factory_video_url', 'https://www.youtube.com/embed/LXb3EKWsInQ');
        $factoryVideoUrl = $this->formatYoutubeEmbedUrl($rawVideoUrl);

        $cabins = Cabin::where('is_active', true)->take(4)->get();
        $diagnosticTests = DiagnosticTest::where('is_active', true)->take(6)->get();
        $medicalEquipments = MedicalEquipment::where('is_active', true)->take(4)->get();

        $bloodStocks = BloodBank::where('is_active', true)->get();
        $faqs = Faq::where('is_active', true)->orderBy('sort_order')->get();
        $healthBlogs = HealthBlog::where('is_active', true)->orderBy('created_at', 'desc')->take(3)->get();
        $healthPackages = \App\Models\Product::where('is_active', true)->take(3)->get();

        return view('frontend.home', compact(
            'categories',
            'featuredProducts',
            'latestJobs',
            'showrooms',
            'slider',
            'buttonTypes',
            'certifications',
            'brands',
            'gallery',
            'directors',
            'factoryVideoUrl',
            'cabins',
            'diagnosticTests',
            'medicalEquipments',
            'bloodStocks',
            'faqs',
            'healthBlogs',
            'healthPackages'
        ));
    }

    private function formatYoutubeEmbedUrl(string $url): string
    {
        if (empty($url)) {
            return 'https://www.youtube.com/embed/LXb3EKWsInQ';
        }

        // If it's already a valid embed URL
        if (str_contains($url, 'youtube.com/embed/')) {
            return $url;
        }

        // Extract video ID from standard watch URL (e.g., youtube.com/watch?v=XXXXX)
        if (preg_match('/v=([a-zA-Z0-9_-]+)/', $url, $matches)) {
            return 'https://www.youtube.com/embed/' . $matches[1];
        }

        // Extract video ID from short URL (e.g., youtu.be/XXXXX)
        if (preg_match('/youtu\.be\/([a-zA-Z0-9_-]+)/', $url, $matches)) {
            return 'https://www.youtube.com/embed/' . $matches[1];
        }

        return 'https://www.youtube.com/embed/LXb3EKWsInQ';
    }

    public function doctorDetails(string $slug): View
    {
        $doctor = Director::where('slug', $slug)->firstOrFail();
        $otherDoctors = Director::where('is_active', true)->where('id', '!=', $doctor->id)->take(3)->get();
        return view('frontend.doctors.show', compact('doctor', 'otherDoctors'));
    }

    public function cabins(): View
    {
        $cabins = Cabin::where('is_active', true)->get();
        return view('frontend.cabins.index', compact('cabins'));
    }

    public function cabinDetails($id): View
    {
        $cabin = Cabin::findOrFail($id);
        $otherCabins = Cabin::where('is_active', true)->where('id', '!=', $cabin->id)->take(3)->get();
        return view('frontend.cabins.show', compact('cabin', 'otherCabins'));
    }

    public function tests(): View
    {
        $tests = DiagnosticTest::where('is_active', true)->get();
        return view('frontend.tests.index', compact('tests'));
    }

    public function equipment(): View
    {
        $equipments = MedicalEquipment::where('is_active', true)->get();
        return view('frontend.equipment.index', compact('equipments'));
    }

    public function equipmentDetails($id): View
    {
        $equipment = MedicalEquipment::findOrFail($id);
        $otherEquipments = MedicalEquipment::where('is_active', true)->where('id', '!=', $equipment->id)->take(3)->get();
        return view('frontend.equipment.show', compact('equipment', 'otherEquipments'));
    }

    public function specialtyDetails($id): View
    {
        $specialty = ButtonType::findOrFail($id);
        $otherSpecialties = ButtonType::where('is_active', true)->where('id', '!=', $specialty->id)->take(3)->get();
        $doctors = Director::where('is_active', true)->take(4)->get();
        return view('frontend.specialties.show', compact('specialty', 'otherSpecialties', 'doctors'));
    }

    public function customOrder(Request $request): \Illuminate\Http\RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:30',
            'booking_type' => 'nullable|string|in:doctor_appointment,medical_service,cabin_booking',
            'doctor_id' => 'nullable|exists:directors,id',
            'cabin_id' => 'nullable|exists:cabins,id',
            'company' => 'nullable|string|max:255',
            'appointment_date' => 'nullable|date',
            'message' => 'nullable|string|max:2000',
            'design_file' => 'nullable|file|mimes:jpg,jpeg,png,pdf,ai,psd,zip|max:10240',
        ]);

        $appointmentDate = $validated['appointment_date'] ?? now()->toDateString();
        $doctorId = $validated['doctor_id'] ?? null;
        $cabinId = $validated['cabin_id'] ?? null;

        // PRESERVE PASSED BOOKING_TYPE EXPLICITLY
        $bookingType = $validated['booking_type'] ?? null;
        if (!$bookingType) {
            if ($doctorId) {
                $bookingType = 'doctor_appointment';
            } elseif ($cabinId) {
                $bookingType = 'cabin_booking';
            } else {
                $bookingType = 'medical_service';
            }
        }

        // Auto Serial Number Calculation
        $lastSerial = 0;
        if ($doctorId) {
            $lastSerial = CustomOrder::where('doctor_id', $doctorId)
                ->whereDate('appointment_date', $appointmentDate)
                ->max('serial_no') ?? 0;
        } elseif ($cabinId) {
            $lastSerial = CustomOrder::where('cabin_id', $cabinId)
                ->whereDate('appointment_date', $appointmentDate)
                ->max('serial_no') ?? 0;
        }

        $data = [
            'booking_type' => $bookingType,
            'doctor_id' => $doctorId,
            'cabin_id' => $cabinId,
            'serial_no' => $lastSerial + 1,
            'appointment_date' => $appointmentDate,
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'company' => $validated['company'] ?? 'General Clinical Service',
            'message' => $validated['message'] ?? '',
            'status' => 'new',
        ];

        if ($request->hasFile('design_file') && $request->file('design_file')->isValid()) {
            $data['design_file'] = $request->file('design_file')->store('custom-designs', 'public');
        }

        $booking = CustomOrder::create($data);

        $typeText = match($bookingType) {
            'cabin_booking' => 'Cabin Reservation',
            'medical_service' => 'Medical Service Booking',
            default => 'Doctor Appointment',
        };

        $serialMessage = $booking->serial_no ? " Your Token Serial Number is #{$booking->serial_no}." : "";
        return back()->with('custom_order_success', "Thank you! Your {$typeText} has been confirmed.{$serialMessage} Our patient desk will contact you within 1 hour.");
    }

    public function about(): View
    {
        $mission = Page::where('slug', 'mission')->first();
        return view('frontend.about.index', compact('mission'));
    }

    public function mission(): View
    {
        $mission = Page::where('slug', 'mission')->first();
        return view('frontend.about.mission', compact('mission'));
    }

    public function history(): View
    {
        $histories = History::orderBy('year', 'desc')->get();
        return view('frontend.about.history', compact('histories'));
    }

    public function directors(): View
    {
        $directors = Director::where('is_active', true)->orderBy('sort_order')->get();
        return view('frontend.about.directors', compact('directors'));
    }

    public function contact(): View
    {
        $contact = Page::where('slug', 'contact')->first();
        return view('frontend.about.contact', compact('contact'));
    }
}