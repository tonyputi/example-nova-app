<?php

namespace App\Nova;

use App\Nova\Actions\UpdateTitle;
use App\Nova\Actions\UpdateTitleStandAlone;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Fields\Trix;
use Laravel\Nova\Http\Requests\NovaRequest;

class Post extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\Post>
     */
    public static $model = \App\Models\Post::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'id';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id',
        'type'
    ];

    public static function availableTypes(): Collection
    {
        return collect(['article', 'tutorial', 'news', 'review'])
            ->mapWithKeys(fn ($type) => [$type => str($type)->headline()->value()]);
    }

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function fields(NovaRequest $request)
    {
        return [
            ID::make()
                ->sortable(),

            Select::make('Type')
                ->options(static::availableTypes())
                ->displayUsingLabels()
                ->filterable()
                ->rules(['required', ['in', ...static::availableTypes()->keys()]]),

            Text::make('Title')
                ->rules('required', 'string', 'max:255'),

            Textarea::make('Excerpt')
                ->rules('required', 'string'),

            Trix::make('Content')
                ->rules('required', 'string'),

            DateTime::make('Created at')
                ->exceptOnForms(),

            DateTime::make('Updated at')
                ->exceptOnForms()
        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function cards(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function filters(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function lenses(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function actions(NovaRequest $request)
    {
        return [
            UpdateTitle::make(),
            UpdateTitleStandAlone::make()
        ];
    }
}
