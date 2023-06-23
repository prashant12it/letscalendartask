<?php

namespace App\Imports;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\CampaignAttendees;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

class AttendeesImport implements ToModel, WithStartRow
{
    public $params;
    public function startRow(): int
    {
        return 2;
    }
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function __construct(Request $request)
    {
        $this->params = $request;
    }
    public function model(array $row)
    {
        $user = User::firstOrNew(['email' => $row[2]]);
        $password = $row[3];
        $cypted_password = bcrypt($password);
        if (!$user->exists) {
            $user->fill([
                "name" => $row[0] . (!empty($row[1]) ? ' ' . $row[1] : ''),
                "password" => $cypted_password,
                "role" => User::ATTENDEE
            ])->save();
        } else {
            $user->name = $row[0] . (!empty($row[1]) ? ' ' . $row[1] : '');
            $user->password = $cypted_password;
            $user->role = User::ATTENDEE;
            $user->save();
        }
        CampaignAttendees::create(
            [
                'campaign_id' => $this->params->campaign_id,
                'user_id' => $user->id,
            ]
        );
    }
}