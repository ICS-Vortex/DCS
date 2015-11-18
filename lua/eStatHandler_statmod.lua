--Handler table
local eStatHandler = {} 


--Neccessary tables for string instead of intagers
SETCoalition = 
{
	[1] = "RED",
	[2] = "BLUE",
}

SETGroupCat = 
{
	[1] = "AIRPLANE",
	[2] = "HELICOPTER",
	[3] = "GROUND",
	[4] = "SHIP",
}

SETfield =
{ 
	[1] = "Time",
	[2] = "Event",
	[3] = "Initiator ID",
	[4] = "Initiator Coalition",
	[5] = "Initiator Group Category",
	[6] = "Initiator Type",
	[7] = "Initiator Player",
	[8]	= "Weapon Category",
	[9]	= "Weapon Name",
	[10] = "Target ID",
	[11] = "Target Coalition",
	[12] = "Target Group Category",
	[13] = "Target Type",
	[14] = "Target Player",
}

SETWeaponCatName = 
{
   [0] = "SHELL",
   [1] = "MISSILE",
   [2] = "ROCKET",
   [3] = "BOMB",
 }
 
 wEvent = {
   "S_EVENT_SHOT",
   "S_EVENT_HIT",
   "S_EVENT_TAKEOFF",
   "S_EVENT_LAND",
   "S_EVENT_CRASH",
   "S_EVENT_EJECTION",
   "S_EVENT_REFUELING",
   "S_EVENT_DEAD",
   "S_EVENT_PILOT_DEAD",
   "S_EVENT_BASE_CAPTURED",
   "S_EVENT_MISSION_START",
   "S_EVENT_MISSION_END",
   "S_EVENT_TOOK_CONTROL",
   "S_EVENT_REFUELING_STOP",
   "S_EVENT_BIRTH",
   "S_EVENT_HUMAN_FAILURE",
   "S_EVENT_ENGINE_STARTUP",
   "S_EVENT_ENGINE_SHUTDOWN",
   "S_EVENT_PLAYER_ENTER_UNIT",
   "S_EVENT_PLAYER_LEAVE_UNIT",
   "S_EVENT_PLAYER_COMMENT",
   "S_EVENT_SHOOTING_START",
   "S_EVENT_SHOOTING_END",
   "S_EVENT_MAX",
 }

--эта таблица нем не нужна, она для записи csv файла 
--statEventsTable = {}

hit_tbl = {}

function SecondsToClock(sSeconds)
local nSeconds = sSeconds
	if nSeconds == 0 then
		--return nil;
		return "00:00:00";
	else
		nHours = string.format("%02.f", math.floor(nSeconds/3600));
		nMins = string.format("%02.f", math.floor(nSeconds/60 - (nHours*60)));
		nSecs = string.format("%02.f", math.floor(nSeconds - nHours*3600 - nMins *60));
		return nHours..":"..nMins..":"..nSecs
	end
end
	
function eStatHandler:onEvent(e)
    local InitID_ = ""
    local WorldEvent = wEvent[e.id]
    local InitCoa = ""
    local InitGroupCat = ""
    local InitType = ""
    local InitPlayer = ""
    local eWeaponCat = ""
    local eWeaponName = ""
    local TargID_ = ""
    local TargType = ""
    local TargPlayer = ""
    local TargCoa = ""
    local TargGroupCat = ""
    
	if e.initiator and Object.getCategory(e.initiator) == Object.Category.UNIT then
	--Initiator variables
		local InitGroup = e.initiator:getGroup()
		InitID_ = e.initiator.id_
		InitCoa = SETCoalition[InitGroup:getCoalition()]
		InitGroupCat = SETGroupCat[InitGroup:getCategory() + 1]
        InitType = e.initiator:getTypeName()
		
		--Get initiator player name or AI if NIL
		if not e.initiator:getPlayerName() then
			InitPlayer = "AI"
		else
			InitPlayer = e.initiator:getPlayerName()
		end
    end

    if e.initiator and Object.getCategory(e.initiator) == Object.Category.STATIC then
    	InitType = e.initiator:getTypeName()
    	InitID_ = e.initiator:getID()
    end

	--Weapon variables	
	if e.weapon == nil then
		eWeaponCat = "No Weapon"
		eWeaponName = "No Weapon"
	else
		local eWeaponDesc = e.weapon:getDesc()
		eWeaponCat = SETWeaponCatName[eWeaponDesc.category]
		eWeaponName = eWeaponDesc.displayName
	end
	
	--Target variables	
	if e.target == nil then
	    TargID_ = "No Target"
		TargType = "No Target"
		TargPlayer = "No Target"
		TargCoa = "No Target"
        TargGroupCat = "No Target"
	elseif Object.getCategory(e.target) == Object.Category.UNIT then
	    local TargGroup = e.target:getGroup()
	    TargID_ = e.target.id_
		TargType = e.target:getTypeName()
		TargCoa = SETCoalition[TargGroup:getCoalition()]
		TargGroupCat = SETGroupCat[TargGroup:getCategory() + 1]
		
		--Get target player name or AI if NIL
		if not e.target:getPlayerName() then
			TargPlayer = "AI"
		else
			TargPlayer = e.target:getPlayerName()
		end
	else
		TargType = e.target:getTypeName()
		TargID_ = "No Target"
		TargPlayer = "No Target"
		TargCoa = "No Target"
        TargGroupCat = "No Target"
	end

	-- Get Static object Type and ID if static is target
	if e.target and Object.getCategory(e.target) == Object.Category.STATIC then
    	TargType = e.target:getTypeName()
    	TargID_ = e.target:getID()
    end
	
    --поскольку для нашего варианта нам не нужна csv таблица закомментим этот блок
	--[[write events to table
	if ((e.id == world.event.S_EVENT_HIT and InitGroupCat == 'AIRPLANE')
	or e.id == world.event.S_EVENT_EJECTION
	or (e.id == world.event.S_EVENT_BIRTH and InitGroupCat == 'AIRPLANE')
	or e.id == world.event.S_EVENT_CRASH
	or e.id == world.event.S_EVENT_DEAD
	or e.id == world.event.S_EVENT_PILOT_DEAD 
	or e.id == world.event.S_EVENT_TAKEOFF
	or e.id == world.event.S_EVENT_LAND then
	statEventsTable[#statEventsTable + 1] = 
			{
				[1] = SecondsToClock(timer.getTime()),
				[2] = WorldEvent,
				[3] = InitID_,
				[4] = InitCoa,
				[5] = InitGroupCat,
				[6] = InitType,
				[7] = InitPlayer,
				[8] = eWeaponCat,
				[9] = eWeaponName,
				[10] = TargID_,
				[11] = TargCoa,
				[12] = TargGroupCat,
				[13] = TargType,
				[14] = TargPlayer,
			}
	end
		--]]

	-- объявим фунцию возврата того, кто стрелял по цели, она нам пригодится для перезаписи
	function returnhitter(target, tbl)

  			local _line_counter = 0
  			for key, value in pairs(tbl) do
      			_line_counter = _line_counter + 1
        			for k, v in pairs(value) do
           				if k == "target" and v == target then
            				return(tbl[_line_counter].hitter)
            			else return nil
           		end
      		end
  		end
    end
		-- функция для заполнения hit_table
	function write_to_hit_table(target, hitter, tbl)

 		-- объявим фунцию, которая будет проверять, есть ли цель в нашей таблице и возвращать её имя
    	function checktarget(target, tbl)
  			for key, value in pairs(tbl) do
    			for k, v in pairs(value) do
        			if k == "target" and v == target then
            			return target
        			end
    			end
   			end
    	end
  		-- если имя не совпало с нашей целью, то значит его в таблице нет и мы его запишем
    	if checktarget(target, tbl) ~= target then
      		table.insert(tbl, {target = target, hitter = hitter})
    	end

  		--[[ объявим фунцию возврата того, кто стрелял по цели, она нам пригодится для перезаписи
    	function returnhitter(target, tbl)

  			local _line_counter = 0
  			for key, value in pairs(tbl) do
      			_line_counter = _line_counter + 1
        			for k, v in pairs(value) do
           				if k == "target" and v == target then
            				return(tbl[_line_counter].hitter)
            			else return nil
           				end
      				end
  			end
    	end
    	--]]

  		-- объявим функцию которая будет перезаписыать хиттера для текущей цели если цель такая есть в таблице
    	function rewritehitter(target, tbl)

  			local _line_counter = 0
  			for key, value in pairs(tbl) do
      			_line_counter = _line_counter + 1
        			for k, v in pairs(value) do
           				if k == "target" and v == target then 
               				if returnhitter(target, tbl) ~= hitter then
            					table.remove(tbl, _line_counter)
            					table.insert(tbl, {target = target, hitter = hitter})
                			end
          				end
        			end
      		end
    	end
	end

	-- объявим функцию, при помощи которой мы будем очищать нужную строку в хит-балице в случае необходимост.
	-- например, когда обстрелянный игрок приземлился и остался жив
	function remove_from_hit_table(target, tbl)
			local _line_counter = 0
			for key, value in pairs(tbl) do
      			_line_counter = _line_counter + 1
        			for k, v in pairs(value) do
           				if k == "target" and v == target then
            					table.remove(tbl, _line_counter)
            			end
            		end
        	end
	end

	-- логируем появление игрока в технике
	if e.id == world.event.S_EVENT_BIRTH then
		trigger.action.outText(string.format(os.date("%m/%d/%Y %H:%M:%S")..";"..InitPlayer..";joined "..InitCoa.." in "..InitType), 10)
	end
	
	-- логируем взлет
	if e.id == world.event.S_EVENT_TAKEOFF then
	    trigger.action.outText(string.format(os.date("%m/%d/%Y %H:%M:%S")..";"..InitPlayer..";take off from;"), 10)
	end
	--логируем сбития игроками воздушных юнитов и записываем килы
	--также после падения игрока нужно очищать таблицу
	if e.id == world.event.S_EVENT_CRASH and returnhitter(InitID_, hit_tbl) ~= nil then
		trigger.action.outText(string.format(os.date("%m/%d/%Y %H:%M:%S")..";"..returnhitter(InitID_, hit_tbl) .. ";" .. "killed" .. ";" .. InitPlayer), 10)
		trigger.action.outText(string.format(os.date("%m/%d/%Y %H:%M:%S")..";"..InitPlayer .. ";" .. "crashed" .. ";"), 10)
		remove_from_hit_table(InitID_, hit_tbl)
	elseif e.id == world.event.S_EVENT_CRASH then
		trigger.action.outText(string.format(os.date("%m/%d/%Y %H:%M:%S")..";"..InitPlayer .. ";" .. "crashed" .. ";"), 10)
		remove_from_hit_table(InitID_, hit_tbl)
	end
	-- логируем посадку
	-- todo, дописать лок чтобы не логировалась посадка после краша об ВВП
	if e.id == world.event.S_EVENT_LAND then
		trigger.action.outText(string.format(os.date("%m/%d/%Y %H:%M:%S")..";"..InitPlayer..";landed at;"), 10)
		remove_from_hit_table(InitID_, hit_tbl)
	end

	--записываем попадания стрелка по цели в таблицу
	--так как данный скрпит в случае наземки даёт ей всей одинковое имя AI, тодля того, 
	--чтобы у нас корректно считалась наземка, мы будем записывать в таблицу не имя цели, а её ID.
	if e.id == world.event.S_EVENT_HIT and e.initiator:getPlayerName() ~= nil then
		write_to_hit_table(TargID_, InitPlayer, hit_tbl)
	end	
    -- логируем смерти наземки или статиков и записываем килы
    if e.id == world.event.S_EVENT_DEAD then
    	trigger.action.outText(string.format(os.date("%m/%d/%Y %H:%M:%S")..";"..returnhitter(InitID_, hit_tbl) .. ";" .. "killed" .. ";" .. InitType), 10)
    	remove_from_hit_table(InitID_, hit_tbl)
    end

    -- логируем прыжки с парашютом
    if e.id == world.event.S_EVENT_EJECTION then
		trigger.action.outText(string.format(os.date("%m/%d/%Y %H:%M:%S")..";"..InitPlayer .. ";" .. "ejected" .. ";"), 10)
	end

end

--где-то здесь должнна быть проверка, чтобы инициализация происходила только на сервере

world.addEventHandler(eStatHandler)
env.info("Initialization complete!")