<?php


namespace PN\Social;


/**
 * Class DiscordService
 *
 * Service to generate instant invite urls and show the online members of the PN Discord chat
 *
 * @package PN\Social
 */
class DiscordService
{
    /**
     * @return array
     */
    private function getData()
    {
        return \Cache::remember('discord.json', 10, function () {
            try {
                $data = json_decode(file_get_contents('https://discordapp.com/api/servers/122309489251581953/widget.json'), true);
            } catch (\Exception $e) {
                $data = [
                    'instant_invite' => '',
                    'members' => [],
                ];
            }

            return $data;
        });
    }

    /**
     * Gets the instant invite url
     *
     * @return string
     */
    public function getUrl()
    {
        return $this->getData()['instant_invite'];
    }

    /**
     * Gets the current online members in discord
     *
     * @return int
     */
    public function getMemberCount()
    {
        return count($this->getData()['members']);
    }
}