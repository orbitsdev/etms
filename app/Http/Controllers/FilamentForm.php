<?php

namespace App\Http\Controllers;

use Closure;
use App\Models\Course;
use App\Models\Request;
use Filament\Forms\Get;
use Filament\Forms\Set;
use App\Models\Equipment;
use App\Models\Department;
use App\Models\UserDetails;
use App\Models\Section as MSection;
use Filament\Forms\Components\Group;
use Illuminate\Support\Facades\Hash;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Textarea;
use Illuminate\Database\Eloquent\Model;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Rawilk\FilamentPasswordInput\Password;
use Filament\Forms\Components\DateTimePicker;
use Illuminate\Contracts\Database\Eloquent\Builder;
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
                    // Select::make('status')
                    //     ->options(Equipment::STATUS_OPTIONS)
                    //     ->native(false)->columnSpan(3)
                    //     ->hidden(fn(string $operation): bool => $operation === 'create')->default(Equipment::AVAILABLE),
                    //    DateTimePicker::make('archived_date')->date()->columnSpan(3)->native(false),
                    SpatieMediaLibraryFileUpload::make('image')->columnSpanFull(),
                ]),
        ];
    }

    public static function manageEquipment(): array
    {
        return [
            Select::make('status')

            ->live(debounce: 500)
            ->options(Equipment::STATUS_OPTIONS)
            ->native(false)->columnSpan(3),

            Textarea::make('issue_description')
            ->label('Issue')
            ->helperText('Kindly describe what is the issue')
            ->columnSpanFull()
            ->required()
            ->rows(5)
            ->hidden(function (Get $get) {
                $hiddenStatuses = [Equipment::UNDER_MAINTENANCE];

    
    return !in_array($get('status'), $hiddenStatuses);
            }),
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
    public static function userForm(): array
    {
        return [

            Section::make('Account Details')
                // ->description('Update your account details. Ensure all required fields are filled.')
                ->columns([
                    'sm' => 3,
                    'xl' => 6,
                    '2xl' => 12,
                ])
                ->schema([
                    TextInput::make('name')
                        ->required()->columnSpan(3)
                        ->maxLength(191),
                    TextInput::make('email')
                        ->email()
                        ->columnSpan(3)
                        ->disabled()
                        ->maxLength(191),
                    //    DateTimePicker::make('email_verified_at'),
                    Password::make('password')
                        ->password()
                        ->columnSpan(3)
                        ->dehydrateStateUsing(fn(string $state): string => Hash::make($state))
                        ->dehydrated(fn(?string $state): bool => filled($state))
                        ->required(fn(string $operation): bool => $operation === 'create')
                        ->helperText('(Change password)')
                        ->label(fn(string $operation) => $operation == 'create' ? 'Password' : 'New password'),
                    TextInput::make('role')
                        ->disabled()
                        ->columnSpan(3),
                    //    Textarea::make('two_factor_secret')
                    //         ->columnSpanFull(),
                    //    Textarea::make('two_factor_recovery_codes')
                    //         ->columnSpanFull(),
                    //    DateTimePicker::make('two_factor_confirmed_at'),
                    //    TextInput::make('current_team_id')
                    //         ->numeric(),
                    FileUpload::make('profile_photo_path')
                        ->disk('public')
                        ->directory('accounts')
                        ->image()
                        ->imageEditor()
                        // ->required()
                        ->columnSpanFull()
                        ->label('PROFILE'),
                ]),
            ...FilamentForm::userDetailsForm(),

        ];
    }

    public static function userDetailsForm(): array
    {
        return [
            Group::make()
                ->relationship('userDetails')
                ->columnSpanFull()
                ->schema([


                    Section::make('User Details')
                        ->description('Please fill out the required details below.')

                        ->columns([
                            'sm' => 3,
                            'xl' => 6,
                            '2xl' => 9,
                        ])
                        ->schema([
                            Select::make('type')
                                ->required()
                                ->label('Designation')
                                ->required()
                                ->hint('Select your designation.')
                                ->options(UserDetails::TYPE_OPTIONS)
                                ->default(UserDetails::STUDENT)
                                ->searchable()
                                ->columnSpan(function ($state, Get $get,) {
                                    if ($get('type') == UserDetails::FACULTY) {
                                        return 6;
                                    } else {
                                        return 9;
                                    }
                                })
                                ->live(debounce: 500)
                                ->afterStateUpdated(function ($state, Get $get, Set $set) {}),

                            TextInput::make('position')
                                ->maxLength(191)->columnSpan(3)
                                ->required()
                                ->hint('ex. Head Faculty')
                                ->hidden(function (Get $get) {
                                    return $get('type') != UserDetails::FACULTY;
                                }),
                            TextInput::make('first_name')
                                ->maxLength(191)->required()->columnSpan(3),
                            TextInput::make('middle_name')->required()->columnSpan(3)
                                ->maxLength(191),
                            TextInput::make('last_name')->required()
                                ->maxLength(191)->columnSpan(3),


                            Select::make('department')
                                ->required()
                                ->label('Building/Department')
                                ->options(Department::all()->pluck('name', 'name'))
                                ->searchable()
                                ->columnSpan(3)
                                ->createOptionForm(FilamentForm::departmentForm()),

                            Select::make('course')
                                ->required()
                                ->label('Course')
                                ->options(Course::all()->pluck('name', 'name'))
                                ->searchable()
                                ->columnSpan(3)
                                ->live(debounce: 500)
                                ->afterStateUpdated(function ($state, Get $get, Set $set) {})
                                ->hidden(function (Get $get) {
                                    return $get('type') != UserDetails::STUDENT;
                                }),


                            Select::make('section')->options(function (Get $get) {
                                if (!empty($get('course'))) {
                                    return MSection::whereHas('course', function ($query) use ($get) {
                                        return $query->where('name', $get('course'));
                                    })->get()->pluck('name', 'name');
                                } else {
                                    return [];
                                }
                            })
                                // ->helperText('If no section is available, it might be no sections was added in the system')
                                ->required()
                                ->preload()
                                ->searchable()
                                ->native(false)

                                ->columnSpan(3)
                                ->hidden(function (Get $get) {
                                    if ($get('type') != UserDetails::STUDENT) {
                                        return true;
                                    }

                                    return $get('course') == null;
                                }),





                        ]),

                    TextInput::make('year')
                        ->label('Academic Year')
                        // ->unique(ignoreRecord: true)
                        ->mask('9999-9999')
                        ->columnSpan(3)
                        ->default(UserDetails::suggestion()),

                ])

        ];
    }

    public static function requestEquipmentForm(): array
    {
        return [

            Group::make()
                ->columnSpanFull()
                ->columns([
                    'sm' => 3,
                    'xl' => 6,
                    '2xl' => 8,
                ])
                ->schema([
                    DatePicker::make('request_date')->date()->columnSpan(4)->required()->closeOnDateSelection()->minDate(today()),
                    //   DateTimePicker::make('actual_return_date'),
                    DatePicker::make('actual_return_date')->date()->columnSpan(4)->required()->closeOnDateSelection()->minDate(today()),
                    Textarea::make('purpose')
                        ->columnSpanFull()
                        ->required()
                        ->rows(5)
                ])->columnSpan(['lg' => 2]),
            Section::make('Items')
            ->description('Select the equipment, specify the required quantity, and ensure it doesn’t exceed the available stock. You can add multiple items to your request as needed.')

                ->columnSpanFull()
                ->columns([
                    'sm' => 3,
                    'xl' => 6,
                    '2xl' => 8,
                ])
                ->schema([
                    TableRepeater::make('request_items')
                        ->relationship('items')
                        ->columnWidths([

                            'quantiy' => '200px',
                        ])
                        ->schema([
                            Select::make('equipment_id')
                                ->label('Equipment')
                                ->relationship(
                                    name: 'equipment',
                                    titleAttribute: 'name',
                                )
                                ->getOptionLabelFromRecordUsing(fn(Model $record) => "{$record->name} - ({$record->stock})")
                                ->live(debounce: 500)
                                ->afterStateUpdated(function ($state, Get $get, Set $set) {
                                    if ($state) {
                                        $equipment = Equipment::find($state);
                                        if ($equipment) {
                                            $set('max_quantity', $equipment->stock);
                                        }
                                    }
                                })
                                ->distinct()
                                ->disableOptionsWhenSelectedInSiblingRepeaterItems()
                                ->preload()
                                ->searchable()
                                ->required(),
                            TextInput::make('quantity')
                                ->live(debounce: 500)
                                ->default(1)
                                ->required()
                                ->numeric()

                                ->helperText(function (Get $get) {
                                    $equipmentId = $get('equipment_id');
                                    if ($equipmentId) {
                                        $equipment = Equipment::find($equipmentId);
                                        return $equipment ? "Maximum quantity available: {$equipment->stock}" : null;
                                    }
                                    return null;
                                })
                                ->rules([
                                    function (Get $get) {
                                        return function (string $attribute, $value, Closure $fail) use ($get) {
                                            $equipmentId = $get('equipment_id');
                                            $equipment = Equipment::find($equipmentId);

                                            if ($equipment && $value > $equipment->stock) {
                                                $fail("The quantity cannot exceed the available stock of {$equipment->stock}.");
                                            }
                                        };
                                    },
                                ]),
                        ])
                        ->addActionLabel('Add Item')
                        ->withoutHeader()
                        ->columnSpan('full')
                        ->label('Items')
                        ->minItems(1)
                ])->columnSpan(['lg' => 2]),




            //   TextInput::make('user_id')
            //     ->required()
            //     ->numeric(),

            //   DateTimePicker::make('pickup_date'),
            //   TextInput::make('user_name_snapshot')
            //         ->maxLength(191),
            //   TextInput::make('equipment_name_snapshot')
            //         ->maxLength(191),
            //   TextInput::make('equipment_serial_snapshot')
            //         ->maxLength(191),
            //   TextInput::make('equipment_department')
            //         ->maxLength(191),
            //   TextInput::make('status')
            //         ->required(),

        ];
    }

    
    public static function manageRequestForm(): array
    {
        return [
            Select::make('status')

            ->live(debounce: 500)
            ->options(Request::STATUS_OPTIONS)
            ->native(false)->columnSpan(3),

            Textarea::make('status_reason')
            ->label('Why?')
            ->helperText('Kindly provide a reason for your decision')
            ->columnSpanFull()
            ->required()
            ->rows(5)
            ->hidden(function (Get $get) {
                $hiddenStatuses = [Request::CANCELED];

    
    return !in_array($get('status'), $hiddenStatuses);
            }),
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
