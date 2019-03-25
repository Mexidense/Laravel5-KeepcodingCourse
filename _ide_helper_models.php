<?php

// @formatter:off
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App{
/**
 * App\Market
 *
 * @property int $id
 * @property string $name
 * @property string $description
 * @property int $active
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Market newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Market newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Market query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Market whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Market whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Market whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Market whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Market whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Market whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property string|null $acronym
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Market whereAcronym($value)
 */
	class Market extends \Eloquent {}
}

namespace App{
/**
 * App\Stock
 *
 * @property int $id
 * @property int $market_id
 * @property string $name
 * @property string $acronym
 * @property string $created_at
 * @property string $updated_at
 * @property Market $market
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Stock newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Stock newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Stock query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Stock whereAcronym($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Stock whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Stock whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Stock whereMarketId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Stock whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Stock whereUpdatedAt($value)
 */
	class Stock extends \Eloquent {}
}

namespace App{
/**
 * App\User
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class User extends \Eloquent {}
}

