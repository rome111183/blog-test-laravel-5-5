<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\User;

class SocialMediaProfile extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'social_media_profile';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'type', 'uid', 'owner_id'
    ];

    /**
     *
     *
     *
     */
    public function user(){

        return $this->belongsTo('App\User');

    }

    /**
     *
     *
     *
     */
    public static function findOrCreateWithGoogle($guser)
    {
        $social = SocialMediaProfile::where('type', 'google')->where('uid', $guser->id)->first();

        if(!$social){
            $user = User::Create([
                        'name' => $guser->name,
                        'email' => $guser->email,
                        'password' => $guser->token,
                    ]);
            $medias = new SocialMediaProfile();
            $medias->type = 'google';
            $medias->uid = $guser->id;

            $user->socialMedias()->save($medias);

        }else{
            $user = User::find($social->user_id);
        }

        return $user;
    }

}
