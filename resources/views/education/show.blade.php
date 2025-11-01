@extends('layouts.app')

@section('title', $content->title . ' - Tension Track')
@section('header', 'Detail Edukasi')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="bg-white rounded-xl shadow-lg overflow-hidden">
        <!-- Header -->
        <div class="p-6 md:p-8 border-b border-gray-200">
            <div class="flex items-start">
                <a href="{{ route('education.index') }}" class="mr-4 text-gray-600 hover:text-gray-800 mt-1">
                    <i class="fas fa-arrow-left"></i>
                </a>
                <div class="flex-1">
                    <div class="flex items-start space-x-4 mb-4">
                        @php
                            $iconColors = [
                                'diet' => 'bg-orange-100 text-orange-600',
                                'exercise' => 'bg-blue-100 text-blue-600',
                                'hydration' => 'bg-cyan-100 text-cyan-600',
                                'medication' => 'bg-purple-100 text-purple-600',
                            ];
                        @endphp
                        <div class="w-16 h-16 {{ $iconColors[$content->category] ?? 'bg-gray-100 text-gray-600' }} rounded-2xl flex items-center justify-center">
                            <i class="fas fa-{{ $content->icon ?? 'info-circle' }} text-3xl"></i>
                        </div>
                        <div class="flex-1">
                            <h1 class="text-3xl font-bold text-gray-800 mb-2">{{ $content->title }}</h1>
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium {{ $iconColors[$content->category] ?? 'bg-gray-100 text-gray-600' }}">
                                {{ ucfirst($content->category) }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Content -->
        <div class="p-6 md:p-8">
            <div class="prose prose-lg max-w-none">
                {!! nl2br(e($content->content)) !!}
            </div>
        </div>
        
        <!-- Call to Action -->
        <div class="p-6 md:p-8 bg-teal-50 border-t border-teal-100">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="font-bold text-gray-800 mb-1">Apakah informasi ini membantu?</h3>
                    <p class="text-sm text-gray-600">Kembali ke halaman edukasi untuk membaca artikel lainnya</p>
                </div>
                <a href="{{ route('education.index') }}" class="px-6 py-3 bg-teal-500 text-white rounded-lg hover:bg-teal-600 transition font-medium shadow-lg">
                    <i class="fas fa-arrow-left mr-2"></i>Kembali
                </a>
            </div>
        </div>
    </div>
</div>
@endsection