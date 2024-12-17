<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Equipment;
use App\Models\Department;
use Illuminate\Http\Request;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Forms\Components\DateTimePicker;
use Awcodes\FilamentTableRepeater\Components\TableRepeater;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;

class FilamentForm extends Controller
{
    public static function equipmentForm(): array
    {
        return [
            Section::make('Equipment Management')
                ->description('Manage and update the equipment content displayed on your platform. This section allows you to maintain and enhance the visual appeal of your site.')
                ->columns([
                    'sm' => 3,
                    'xl' => 8,
                    '2xl' => 9,
                ])
                ->schema([
                    TextInput::make('name')
                        ->maxLength(191)->required()->columnSpanFull(),
                    TextInput::make('serial_number')
                        ->unique(ignoreRecord: true)
                        ->columnSpan(3)
                        ->maxLength(191),
                    TextInput::make('stock')
                        ->required()->columnSpan(3)
                        ->numeric()
                        ->default(1)->required()->mask(9999),
                    //    TextInput::make('status')
                    //         ->required()  ->columnSpan(3),
                    //    TextInput::make('location')
                    //         ->maxLength(191)->columnSpan(3),
                    Select::make('status')
                        ->options(Equipment::STATUS_OPTIONS)
                        ->native(false)->columnSpan(3)
                        ->hidden(fn(string $operation): bool => $operation === 'create')->default(Equipment::AVAILABLE),
                    //    DateTimePicker::make('archived_date')->date()->columnSpan(3)->native(false),
                    SpatieMediaLibraryFileUpload::make('image')->columnSpanFull(),
                ]),
        ];
    }
   

    public static function departmentForm(): array
    {
        return [


            TextInput::make('name')->required()
            ->label('BUILDING/DEPARTMENT')
                ->unique(ignoreRecord: true)
                ->columnSpanFull(),

        ];
    }


    public static function courseForm(): array
    {
        return [

            Section::make('')
                ->columns([
                    'sm' => 3,
                    'xl' => 6,
                    '2xl' => 9,
                ])
                ->schema([
                    TextInput::make('name')->required()->label('NAME')
                        ->unique(ignoreRecord: true,)
                        ->columnSpanFull(),
                   


                    TableRepeater::make('course_sections')
                        ->relationship('sections')
                        ->schema([
                            TextInput::make('name')->required(),
                        ])
                        ->withoutHeader()
                        ->columnSpan('full')
                        ->label('Sections')

                ]),





        ];
    }

    public static function userDetailsForm(): array
    {
        return [
            Group::make()
                ->relationship('userDetails')
                ->schema([


                    Section::make('')
                        ->columns([
                            'sm' => 3,
                            'xl' => 6,
                            '2xl' => 9,
                        ])
                        ->schema([
                            TextInput::make('first_name')
                                ->maxLength(191)->required(),
                            TextInput::make('middle_name')->required()
                                ->maxLength(191),
                            TextInput::make('last_name')->required()
                                ->maxLength(191),
                            TextInput::make('type')
                                ->required(),

                            TextInput::make('department')
                                ->maxLength(191),
                            TextInput::make('course')
                                ->maxLength(191),
                            TextInput::make('section')
                                ->maxLength(191),
                            TextInput::make('position')
                                ->maxLength(191),
                            TextInput::make('year')
                                ->maxLength(191),
                        ])
                ])

        ];
    }

    public static function sectionForm(): array
    {
        return [
            TextInput::make('name')
                ->required()
                ->unique(ignoreRecord: true)
                ->columnSpan(2),
            Select::make('course_id')->label('Course')
                ->options(Course::all()->pluck('name', 'id'))
                ->preload()
                ->columnSpan(2)
                ->searchable(),

        ];
    }

    public static function success(String $title = 'Success', String $body = null)
    {
        Notification::make()
            ->title($title)
            ->body($body)
            ->success()
            ->send();
    }
    public static function danger(String $title = 'Success', String $body = null)
    {
        Notification::make()
            ->title($title)
            ->body($body)
            ->danger()
            ->send();
    }
}
