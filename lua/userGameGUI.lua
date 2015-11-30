-- логирование начала подгрузки скрипта в ДКС
-- Комментарий Vortex-а
net.log("Stat script loading...")
-- Функция для отправки сообщения на URL методом POST на сервер статистики

local save_stat = function(str)
	-- делаем save/restore оригинального package.path DCS, чтобы он перезаписывался, и не отключался UI
	local _original_package_path = package.path
		package.path = "./LuaSocket/?.lua"
		local http = require("socket.http")
	package.path = _original_package_path

	--	http.request("http://jiran.t2me.ru/stat.php?name="..url_encode(os.date("%c") .. ";" .. str)) 

	local request_body = "postname=" .. os.date("%c") .. ";" .. string.gsub(str,"\"","")
	local response_body = { }
	local res, code, response_headers = socket.http.request
	{
		url = "http://burningskies-stats.16mb.com/statistics/record/";
		method = "POST";
		headers = 
	{
		["Content-Type"] = "application/x-www-form-urlencoded";
		["Content-Length"] = #request_body;
	};
		source = ltn12.source.string(request_body);
		sink = ltn12.sink.table(response_body);
	}
end
-- логируем в dcs.log, чтобы убедиться, что функция подгрузилась (можно удалить или закомментить)
--net.log("HTTP request to stat server loaded...")

--впомогательная вункция для получения missionID юнита
--function DCS.getMissionIdFromSlotId(slotID)
 --   return string.match(slotID, '%d+')
--end

-- callback функция при старте симуляции
function onSimulationStart()
-- отправляем на сервер статистики, как результат: ONLINE
	save_stat("Server;Start")
	net.log("Server;Start")
end
-- логируем в dcs.log, чтобы убедиться, что функция подгрузилась (можно удалить или закомментить)
--net.log("On server stat report loaded...")

-- сallback функция при остановке симуляции
function onSimulationStop()
-- отправляем на сервер статистики, как результат: OFFLINE
	save_stat("Server;Stop")
	net.log("Server;Stop")
end
--net.log("On server stop report loaded...")

--callback функция при появлении нового игрока на сервере (в симуляци), происходит после коннекта игрока
function onPlayerStart(id)
	local _player_name = net.get_player_info(id, 'name')
	local _player_ucid = net.get_player_info(id, 'ucid')
	--отправляем на сервер статистики, как результат игрок появляется в списке наблюдателей
	save_stat(_player_name..";entered;".._player_ucid)
	--вспомогательная запись в лог. (можно удалить или закомментить)
	net.log(_player_name..";entered;".._player_ucid)
end
--net.log("On player entering simulation report loaded...")

--callback функция при уходе игрока из симуляции, происходит прямо перед дисконнектом игрока
function onPlayerStop(id)
 	local _player_name = net.get_player_info(id, 'name')
 	--local _player_ucid = net.get_player_info(id, 'ucid')
	--отправляем на сервер статистики, как результат игрок исчезает из списка игроков онлайн
	save_stat(_player_name..";left;server")--;".._player_ucid)
	--вспомогательная запись в лог. (можно удалить или закомментить)
	net.log(_player_name..";left;server")--;".._player_ucid)
end
--net.log("On player leaving simulation report loaded...")

--[[
--сallback функция при дисконнекте игрока от сервера
function onPlayerDisconnect(id, err)
	local _player_name = net.get_player_info(id, 'name')
	--local _player_ucid = net.get_player_info(id, 'ucid')
	--отправляем на сервер статистики, как результат игрок исчезает из списка игроков онлайн
	save_stat(_player_name..";left the game;")--.._player_ucid)
	--вспомогательная запись в лог. (можно удалить или закомментить)
	net.log(_player_name..";left the game;")--.._player_ucid)
end
--]]
-- самая главная функция, вызывается при любом событии на сервере
function onGameEvent(eventName,arg1,arg2,arg3,arg4,arg5,arg6,arg7)
	if eventName == "disconnect" then
		local _player_name = arg2
		--local _player_ucid = net.get_player_info(arg1, 'ucid')
		--отправляем на сервер статистики, как результат игрок исчезает из списка игроков онлайн
		save_stat(_player_name..";left;server")--;".._player_ucid)
		--вспомогательная запись в лог. (можно удалить или закомментить)
		net.log(_player_name..";left;server")--;".._player_ucid)
    elseif eventName == "crash" then
    	local _player_name = net.get_player_info(arg1, 'name')
    	local _player_ucid = net.get_player_info(arg1, 'ucid')
		--отправляем прыжок игрока на сервер статистики
		save_stat(_player_name..";crashed;".._player_ucid)
		--вспомогательная запись в лог. (можно удалить или закомментить)
		net.log(_player_name..";crashed;".._player_ucid)
    --при прыжке пилота
    elseif eventName == "eject" then
    	local _player_name = net.get_player_info(arg1, 'name')
    	local _player_ucid = net.get_player_info(arg1, 'ucid')
		--отправляем прыжок игрока на сервер статистики
		save_stat(_player_name..";ejected;".._player_ucid)
		--вспомогательная запись в лог. (можно удалить или закомментить)
		net.log(_player_name..";ejected;".._player_ucid)
    --при взлёте игрока
    elseif eventName == "takeoff" then
    	local _player_name = net.get_player_info(arg1, 'name')
		local _airdrome_name = arg3
		local _player_ucid = net.get_player_info(arg1, 'ucid')
		--если игрок взлетел с аэродрома
			if airdrome_name ~= "" then
				--отправляем взлёт игрока на сервер статистики
				save_stat(_player_name..";takeoff from;".._player_ucid..";".._airdrome_name)
				--вспомогательная запись в лог. (можно удалить или закомментить)
				net.log(_player_name..";takeoff from;".._player_ucid..";".._airdrome_name)
				-- если не с аэродрома, то
			else
				save_stat(_player_name..";takeoff;".._player_ucid)
				--вспомогательная запись в лог. (можно удалить или закомментить)
				net.log(_player_name..";takeoff;".._player_ucid)
			end
	--при посадке игрока
    elseif eventName == "landing" then
    	local _player_name = net.get_player_info(arg1, 'name')
		local _airdrome_name = arg3
		local _player_ucid = net.get_player_info(arg1, 'ucid')
		--если игрок сел на аэродроме
		if airdrome_name ~= "" then
			--отправляем посадку игрока на сервер статистики
			save_stat(_player_name..";landed at;".._player_ucid..";".._airdrome_name)
			--вспомогательная запись в лог. (можно удалить или закомментить)
			net.log(_player_name..";landed at;".._player_ucid..";".._airdrome_name)
		-- если не на аэродроме, то
		else
			save_stat(_player_name..";landed at;".._player_ucid)
			--вспомогательная запись в лог. (можно удалить или закомментить)
			net.log(_player_name..";landed at;".._player_ucid)
		end
	--[[ это пока не нужно. можно включить в будущем
    elseif eventName == "mission_end" then
        onChatMessage(base.string.format(_("Mission is over.")))
        if DCS.isServer() == true then
            net.load_next_mission() 
        end
    --]]
    --при убийстве пилота, вызывается, если пилот был убит            
    elseif eventName == "kill" then   --onGameEvent(kill,idPlayer1,typeP1,coalition1, idP2,typeP2, coalition2, weapon)
    	local _killed_player_name = net.get_player_info(arg4, 'name')
    	local _killed_player_ucid = net.get_player_info(arg4, 'ucid')
		local _weapon_name = arg7
		local _killer_player_name = net.get_player_info(arg1, 'name')
		local _killer_player_ucid = net.get_player_info(arg1, 'ucid')
		local _killed_target_type = arg5
		local _killed_target_category = "AI"--DCS.getUnitProperty(arg4, DCS.UNIT_CATEGORY)
			--если игрока убил не бот и передалось имя вооружения
			if _killer_player_name ~= nil and _weapon_name ~= nil and _killed_player_name ~= nil then
				--отправляем запись об убийстве на сервер статистики
				save_stat(_killer_player_name..";killed;".._killer_player_ucid..";".._killed_player_name..";".._killed_player_ucid..";"..50)
				--вспомогательная запись в лог. (можно удалить или закомментить)
				net.log(_killer_player_name..";killed;".._killer_player_ucid..";".._killed_player_name..";".._killed_player_ucid..";"..50)
			--если игрока убил не бот и НЕ передалось имя вооружения
			elseif _killer_player_name ~= nil and _weapon_name == nil and _killed_player_name ~= nil then
				--отправляем запись об убийстве на сервер статистики
				save_stat(_killer_player_name..";killed;".._killer_player_ucid..";".._killed_player_name..";".._killed_player_ucid..";"..50)
				--вспомогательная запись в лог. (можно удалить или закомментить)
				net.log(_killer_player_name..";killed;".._killer_player_ucid..";".._killed_player_name..";".._killed_player_ucid..";"..50)
			--если игрок убил бота и оружие известно
			elseif _killer_player_name ~= nil and _weapon_name ~= nil and _killed_player_name == nil then
				--отправляем запись об убийстве на сервер статистики
				save_stat(_killer_player_name..";killed;".._killer_player_ucid..";".._killed_target_category..";".._killed_target_type..";"..5)
				--вспомогательная запись в лог. (можно удалить или закомментить)
				net.log(_killer_player_name..";killed;".._killer_player_ucid..";".._killed_target_category..";".._killed_target_type..";"..5)
			--если игрок убил бота и оружие не известно
			elseif _killer_player_name ~= nil and _weapon_name == nil and _killed_player_name == nil then
				--отправляем запись об убийстве на сервер статистики
				save_stat(_killer_player_name..";killed;".._killer_player_ucid..";".._killed_target_category..";".._killed_target_type..";"..5)
				--вспомогательная запись в лог. (можно удалить или закомментить)
				net.log(_killer_player_name..";killed;".._killer_player_ucid..";".._killed_target_category..";".._killed_target_type..";"..5)
			--если игрока убил бот
			elseif _killer_player_name == nil and _killed_player_name ~= nil then
				--отправляем запись о смерти на сервер статистики
				save_stat(_killed_player_name..";dead;".._killed_player_ucid)
				--вспомогательная запись в лог. (можно удалить или закомментить)
				net.log(_killed_player_name..";dead;".._killed_player_ucid)
			end
    --при самоубийстве игрока, например от собственной бомбы
    elseif eventName == "self_kill" then 
    	local _player_name = net.get_player_info(arg1, 'name')
    	local _player_ucid = net.get_player_info(arg1, 'ucid')
		--отправляем запись о смерти на сервер статистики
		save_stat(_player_name..";dead;".._player_ucid)
		--вспомогательная запись в лог. (можно удалить или закомментить)
		net.log(_player_name..";dead;".._player_ucid)
    --выбор игроком слота, происходит когда...(протесттить:)
    elseif eventName == "change_slot" then
 		-- a player successfully changed the slot
 		-- this will also come as onGameEvent('change_slot', playerID, slotID)
 		local _player_name = net.get_player_info(arg1, 'name')
 		local _player_ucid = net.get_player_info(arg1, 'ucid')
		local _player_side_id = net.get_player_info(arg1, 'side')
		local _player_side
		-- определяем тип юнита по UnitID
		local _player_aircraft_type = DCS.getUnitType(arg2)
		--local _player_slot_id = net.get_player_info(id, 'slot')
		--local _mission_id = DCS.getMissionIdFromSlotId(_player_slot_id)
		--local _player_vehicle_type = DCS.getUnitType(_mission_id) --возможно slotByUnitId[arg2].type не будет работать, тогда надо вернуть slot_id и из него взять тип
		--SideID: 0 - spectators, 1 - red, 2 - blue
		if _player_side_id == 0 then
			_player_side = "SPECTATORS"
			--если спектатор, то нас не интересует тип юнита игрока, поэтому сразу отправляем на сервер статистики, как результат игрок отображается в наблюдателях
			save_stat(_player_name..";joined SPECTATORS;".._player_ucid)
			--вспомогательная запись в лог. (можно удалить или закомментить)
			net.log(_player_name..";joined SPECTATORS;".._player_ucid)
		elseif _player_side_id == 1 then
			_player_side = "RED"
			--если за красных, то пока пишу ID cлота, в будущем по ID cлота нужно определить тип юнита (P-51D и т.п.) похоже это делается с помощью DCS.getUnitType(missionId)
			save_stat(_player_name..";joined ".._player_side..";".._player_ucid..";".._player_aircraft_type) --";".._player_vehicle_type)
			--вспомогательная запись в лог. (можно удалить или закомментить)
			net.log(_player_name..";joined ".._player_side..";".._player_ucid..";".._player_aircraft_type) --";".._player_vehicle_type)
		elseif _player_side_id == 2 then
			_player_side = "BLUE"
			--если за синих, то пока пишу ID cлота, в будущем по ID cлота нужно определить тип юнита (P-51D и т.п.) похоже это делается с помощью DCS.getUnitType(missionId)
			save_stat(_player_name..";joined ".._player_side..";".._player_ucid..";".._player_aircraft_type)--..";".._player_vehicle_type)
			--вспомогательная запись в лог. (можно удалить или закомментить)
			net.log(_player_name..";joined ".._player_side..";".._player_ucid..";".._player_aircraft_type)--..";".._player_vehicle_type)
		end
	--[[это пока не нужно можно включить в будущем, если пригодится
    elseif eventName == "connect" then 
        onChatMessage(base.string.format("%s ".._("connected to the server"),getPlayerName(arg1)))        
    elseif eventName == "disconnect" then
		local player = parseSide(arg3).." "..cdata.player.." "..arg2
        onChatMessage(base.string.format("%s ".._("disconnected"), player))
    elseif eventName == "friendly_fire" then 
        onChatMessage(base.string.format("%s ".._("hit allied").." %s ".._("with").." %s",getPlayerInfo(arg1),getPlayerName2(arg3), arg2))
    else
        onChatMessage(base.string.format("unknown %s %s %s",eventName, arg1,arg2,arg3))
    --]]
    end  
    --[[
        "crash", playerID, event.initiator_misID
        "eject", playerID, event.initiator_misID
        "takeoff", event.initiator_misID, event.s_place
        "landing", playerID, event.initiator_misID, event.s_place
        "mission_end", winner, msg
        "kill", playerID, hit.s_weapon, event_.initiator_misID
        "player_kill", playerID, event_.initiator_misID
        ]]
end
net.log("Stat script loaded")
--callback функция при дружественном огне
--[[
function onGameEvent(friendly_fire, playerID, weaponName, victimPlayerID)
	local _team_damager_player_name = net.get_player_info(playerID, 'name')
	local _weapon_name = weaponName
	local _victim_player_name = net.get_player_info(victimPlayerID, 'name')
	if _team_damager_player_name ~= "" and _victim_player_name ~= "" then
		--отправляем запись о тимдамаге на сервер статистики
		save_stat(_team_damager_player_name..";team-damaged;".._victim_player_name)
		--вспомогательная запись в лог. (можно удалить или закомментить)
		net.log(_team_damager_player_name..";team-damaged;".._victim_player_name)
	end

end
--]]
